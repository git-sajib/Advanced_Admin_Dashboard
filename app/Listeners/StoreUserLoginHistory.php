<?php

namespace App\Listeners;

use App\Events\LoginHistory;
use App\Models\UserLoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreUserLoginHistory
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
    public function handle(LoginHistory $event)
    {

        /**
         * Save user-login history to database
         */
        $userinfo = $event->user;

        $loginHistory = UserLoginHistory::create([
            'user_id' => $userinfo->id,
            'name' => $userinfo->name,
            'email' => $userinfo->email,
        ]);

        return $loginHistory;
    }
}
