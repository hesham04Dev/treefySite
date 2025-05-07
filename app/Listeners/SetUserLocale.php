<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\App;

class SetUserLocale
{
    public function handle(Authenticated $event): void
    {
        $user = $event->user;

        if ($user && $user->language) {
            App::setLocale($user->language->code);
        }
    }
}

