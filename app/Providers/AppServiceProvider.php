<?php

namespace App\Providers;

use App\Models\LanguageRequest;
use App\Models\Project;
use App\Models\Translator;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrap();
        User::updated(function ($user) {
            if ($user->isDirty('is_banned') && $user->is_banned) {
                Project::where('user_id', $user->id)->update(['is_disabled' => 1]);
            }
        });


        Project::saving(function ($project) {
            // Only modify the name if it's a new project or the name is being updated
            if ($project->isDirty('name')) {
                $baseName = $project->name;
                $name = $baseName;
                $counter = 1;

                // Ensure the name is unique by checking the database
                while (Project::where('name', $name)->exists()) {
                    // Append a random string or a counter if the name already exists
                    $randomString = Str::upper(Str::random(8)); 
                    $name = "{$randomString}-{$baseName}"; // Example: "Project ABCD"
                    $counter++;
                }

                $project->name = $name; // Update the project name to the unique one
            }
        });
        
        LanguageRequest::updated(function ($req) {
            if ($req->isDirty('is_approved')) {
                $translator = Translator::where('user_id', $req->translator_id)->first();
                if ($translator) {
                    if ($req->is_approved) {
                        $translator->languages()->syncWithoutDetaching([$req->language_id]);
                    } else {
                        $translator->languages()->detach([$req->language_id]);
                    }
                }
            }
        });

        Model::unguard();
    }
}
