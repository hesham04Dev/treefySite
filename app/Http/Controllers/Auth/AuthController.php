<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use \Hash;
use \Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function view_signin()
    {
        return view('auth.signing');
    }
    public function view_signup()
    {
        return view('auth.signup');
    }

    public function signup()
    {
        try {
            request()->validate([
                'email' => 'required|email|unique:users,email',
                'name' => 'required|string|max:255',
                'password' => 'required|min:6',
            ]);
    
            $user = User::create([
                'email' => request('email'),
                'name' => request('name'),
                'password' => bcrypt(request('password')),
            ]);
    
            Auth::login($user);
    
            // return response()->json(['message' => 'User registered and logged in successfully'], 201);
            return redirect('/home');
    
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function signin()
    {
        $user = User::where('email', request('email'))->first();

        if ($user && Hash::check(request('password'), $user->password)) {
            Auth::login($user);
            return redirect('/home');
        } else {

            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
