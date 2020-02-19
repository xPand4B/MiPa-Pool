<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\Log;
use App\Notifications\AddEmailNotification;

class CheckIfEmailExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($user = Auth::user()) {
            if (! isset($user->email)) {
                if ($user->notifications->where('type', 'App\Notifications\AddEmailNotification')->count() == 0 ) {
                    $user->notify(new AddEmailNotification($user->id));
                    Log::info("User #".Auth::user()->id." has received the 'AddEmail' notification.");
                }
            }else{
                if ($user->notifications->where('type', 'App\Notifications\AddEmailNotification')->count() == 1 ) {
                    $user->notifications->where('type', 'App\Notifications\AddEmailNotification')->first()->markAsRead();
                }
            }
        }

        return $next($request);
    }
}
