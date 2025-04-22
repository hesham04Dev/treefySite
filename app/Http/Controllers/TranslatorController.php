<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranslatorController extends Controller
{
    public function view_dashboard(){
        $user = auth()->user();
        $points = 1000;
        $level_percentage = "10%";
        return view("translator.dashboard",compact("user", "points","level_percentage"));
    }
}
