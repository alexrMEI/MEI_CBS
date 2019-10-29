<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Carbon\Carbon;
use App\FailedLoginAttempt;

class RecordFailedLoginAttempt
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
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        FailedLoginAttempt::record(
            $event->user,
            $event->credentials['email'],
            request()->ip()
        );

        $counter = 0;

        $userAttempts = FailedLoginAttempt::where('user_id', $event->user->id)->orderBy('created_at', 'desc')->take(3)->get();

        $lastFailedAttempt = $userAttempts->last()->created_at;

        // Replace with notification/alert in the system
        /*
        if ($lastFailedAttempt->gt(Carbon::now()->subMinutes(15))) {
            var_dump('User login failed 3 times in the past 15 minutes, ip: ' . $userAttempts->last()->ip_address);
            var_dump('Last failed at: ' . Carbon::createFromFormat('Y-m-d H:i:s', $lastFailedAttempt)->format('Y-m-d H:i:s'));
            die;
        }
        */
    }
}