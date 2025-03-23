<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetTenantAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        if ($user->hasRole('Student')) {
        } else {
            session([
                'user_roles' => $user->getRoleNames()->toArray(),
                'institution_id' => $user->institution_id,
                'institution_name' => $user->institution->name
            ]);
        }
    }
}
