<?php

namespace App\Providers;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     */
    public function boot()
    {
        // VerifyEmail::toMailUsing(function($notifiable) {
        //     $verifyURL = URL::temporarySignedRoute(
        //         'verification.verify', Carbon::now()->addMinute(60), ['id' => $notifiable->getKey()]
        //     );

        //     return (new MailMessage())
        //         ->subject(trans('mail.verify.subject'))
        //         ->line(trans('mail.verify.line'))
        //         ->action(trans('mail.verify.action'), $verifyURL)
        //         ->markdown('mails.verify', [
        //             'user' => Auth::user(),
        //         ]);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
