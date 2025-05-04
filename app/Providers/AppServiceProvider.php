<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

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
        User::updated(function ($user) {
            if ($user->isDirty('is_banned') && $user->is_banned) {
                Project::where('user_id', $user->id)->update(['is_disabled' => 1]);
            }
        });
        Model::unguard();
    }
}
