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

        if ($event->user != NULL) {

            $userAttempts = FailedLoginAttempt::where('user_id', $event->user->id)->orderBy('created_at', 'desc')->take(3)->get();

            $lastFailedAttempt = $userAttempts->last()->created_at;

            // Replace with notification/alert in the system
            if ($lastFailedAttempt->gt(Carbon::now()->subMinutes(15))) {
                \Log::info(Carbon::createFromFormat('Y-m-d H:i:s', $lastFailedAttempt)->format('Y-m-d H:i:s') . ' ' . $userAttempts->last()->ip_address . ' User login failed 3 times in the past 15 minutes.');
            }
        } else {

            $ipAttempts = FailedLoginAttempt::where('ip_address', request()->ip())->orderBy('created_at', 'desc')->take(3)->get();

            $lastFailedAttempt = $ipAttempts->last()->created_at;

            // Replace with notification/alert in the system
            if ($lastFailedAttempt->gt(Carbon::now()->subMinutes(15))) {
                \Log::info(Carbon::createFromFormat('Y-m-d H:i:s', $lastFailedAttempt)->format('Y-m-d H:i:s') . ' ' . $userAttempts->last()->ip_address . ' User login failed 3 times in the past 15 minutes.');
            }
        }

        
    }
}
