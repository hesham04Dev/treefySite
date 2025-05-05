<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view_profile(){
        if(auth()->user()->isTranslator()){
            return view("translator.profile");
        }
        return view("user.profile");
    }
}
