<?php

namespace App\Components\Common\Mail\Auth;

use App\Components\Common\Traits\MiPaPoMailer;
use App\Components\User\Database\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, MiPaPoMailer;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $token
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->setToken($token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this
            ->subject(trans('mail.reset.subject'))
            ->introLines([
                trans('mail.reset.introLines.01')
            ])
            ->action(trans('mail.reset.action'), route('password.reset', $this->token))
            ->outroLines([
                trans('mail.reset.outroLines.02')
            ])
            ->markdown('mails.default');

        Log::info("User #".$this->user->id." has requested a 'password reset' email.");

        return $mail;


    }
}
