<?php

namespace App\Providers;

use App\Providers\UserWasLogged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserLastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasLogged  $event
     * @return void
     */
    public function handle(UserWasLogged $event)
    {
        //
    }
}
