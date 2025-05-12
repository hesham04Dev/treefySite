<?php

namespace App\Http\Controllers;

use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PointController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('points.index', compact('user'));
    }

    // 🟩 Form Pages
    public function showPurchaseForm()
    {
        return view('points.purchase');
    }

    public function showSellForm()
    {
        return view('points.sell');
    }

    public function showTransferForm()
    {
        return view('points.transfer');
    }

    // 🟩 Purchase Points (PayPal)
    public function createPurchase(Request $request, PayPalService $paypal)
    {
        $points = (int) $request->input('points');
        if ($points <= 0) {
            return redirect()->back()->with('error', 'Invalid points amount.');
        }

        $amount = $points * config('app.points_to_usd');
        Session::put('points_to_add', $points);

        $response = $paypal->createOrder($amount);

        foreach ($response->result->links as $link) {
            if ($link->rel === 'approve') {
                return redirect($link->href);
            }
        }

        return redirect()->route('points.purchase.form')->with('error', 'Could not initiate PayPal.');
    }

    public function purchaseSuccess(PayPalService $paypal)
    {
        $orderId = request('token');
        $paypal->captureOrder($orderId);

        $points = Session::pull('points_to_add', 0);
        if ($points > 0) {
            $user = auth()->user();
            $user->increment('points', $points);

            DB::table('transactions')->insert([
                'debit_user_id' => null,
                'credit_user_id' => $user->id,
                'amount' => $points,
                'transaction_type_id' => 1, // purchase
                'created_at' => now(),
            ]);
        }

        return redirect()->route('points.purchase.form')->with('success', "$points points purchased!");
    }

    public function purchaseCancel()
    {
        return redirect()->route('points.purchase.form')->with('error', 'Payment canceled.');
    }

    // 🟩 Sell Points
    // public function sellPoints(Request $request)
    // {
    //     $points = (int) $request->input('points');
    //     $user = auth()->user();

    //     if ($points <= 0 || $points > $user->points) {
    //         return redirect()->back()->with('error', 'Invalid points.');
    //     }

    //     DB::transaction(function () use ($user, $points) {
    //         $user->decrement('points', $points);

    //         DB::table('transactions')->insert([
    //             'debit_user_id' => $user->id,
    //             'credit_user_id' => null,
    //             'amount' => $points,
    //             'transaction_type_id' => 2, // sell
    //             'created_at' => now(),
    //         ]);
    //     });

    //     return redirect()->route('points.sell.form')->with('success', 'Sale request submitted successfully.');
    // }

    public function sellPoints(Request $request, PayPalService $paypal)
{
    $points = (int) $request->input('points');
    $user = auth()->user();

    if ($points <= 0 || $points > $user->points) {
        return redirect()->back()->with('error', 'Invalid points.');
    }

    DB::transaction(function () use ($user, $points, $paypal) {
        $user->decrement('points', $points);

        DB::table('transactions')->insert([
            'debit_user_id' => $user->id,
            'credit_user_id' => null,
            'amount' => $points,
            'transaction_type_id' => 2, // sell
            'created_at' => now(),
        ]);

        $usdAmount = $points * config('app.points_to_usd');
        $paypal->sendPayout($user->email, $usdAmount, "Selling $points points");
    });

    return redirect()->route('points.sell.form')->with('success', 'Money sent to your PayPal!');
}


    // 🟩 Transfer Points to Another User
    public function sendPoints(Request $request)
    {
        $points = (int) $request->input('points');
        $receiverEmail = $request->input('email');
        $sender = auth()->user();

        $receiver = DB::table('users')->where('email', $receiverEmail)->first();

        if (!$receiver) {
            return redirect()->back()->with('error', 'Receiver not found.');
        }
        if($receiverEmail == $sender->email){
            return redirect()->back()->with('error', 'You cannot send points to yourself.');
        }

        if ($points <= 0 || $points > $sender->points) {
            return redirect()->back()->with('error', 'Invalid points.');
        }

        DB::transaction(function () use ($sender, $receiver, $points) {
            DB::table('users')->where('id', $sender->id)->decrement('points', $points);
            DB::table('users')->where('id', $receiver->id)->increment('points', $points);

            DB::table('transactions')->insert([
                'debit_user_id' => $sender->id,
                'credit_user_id' => $receiver->id,
                'amount' => $points,
                'transaction_type_id' => 3, // transfer
                'created_at' => now(),
            ]);
        });

        return redirect()->route('points.transfer.form')->with('success', 'Points sent successfully.');
    }
}
