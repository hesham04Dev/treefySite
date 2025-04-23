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

    public function view_verification(Request $request){
        // $user = auth()->user();
        $project_id = $request->input("project_id");
       
        return view("translator.verification");
    }
}
