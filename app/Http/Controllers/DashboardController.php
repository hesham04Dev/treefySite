<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view_dashboard()
    {
        if ($this->check_is_new_user()) {
            return redirect("user/fill_missing_data");
        }
        if ($this->check_is_translator()) {
            return redirect("translator/dashboard");
        }

        $user = auth()->user();
        $points = 0;

        return view('publisher.dashboard',compact("user","points"));
    }

    private function check_is_new_user()
    {
        return auth()->user()->is_new_user;
    }

    private function check_is_translator()
    {
        return auth()->user()->isTranslator();
    }
}
