<?php

namespace App\Http\Controllers;

use App\Models\Translator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view_fill_missing_data()
    {
        return view("user.fill_missing_data");
    }
    public function fill_missing_data()
    {
        $user = auth()->user();

        // Check if the user is a translator and should fill in their missing data
        if (request("is_translator")) {
            $translator = new Translator();

            // If a CV is uploaded, store it and assign the path to the translator
            if (request()->hasFile('cv') && request()->file('cv')->isValid()) {
                $cvPath = request()->file('cv')->store('cv_uploads', 'public'); // Store in 'storage/app/public/cv_uploads'
                $translator->cv_path = $cvPath; // Store CV path in the translator's record
            }

            // Store the description and any other translator info
            $translator->desc = request("desc");

            if (request()->has('languages')) {
                $languages = request('languages'); // Assume it's an array of language IDs
                $translator->languages()->attach($languages);
            }

            $translator->user_id = $user->id; // Assign user ID to the translator record
            $translator->save(); // Save the translator record

            $user->is_new_user = false;
            $user->save();
        }

        // Optionally, you could redirect the user after the process is complete
        return redirect('/dashboard');
    }

    
}
