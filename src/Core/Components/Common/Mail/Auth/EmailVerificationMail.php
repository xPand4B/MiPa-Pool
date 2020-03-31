<?php

namespace MiPaPo\Core\Components\Common\Mail\Auth;

use MiPaPo\Core\Components\Common\Traits\MiPaPoMailer;
use MiPaPo\Core\Components\User\Database\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, MiPaPoMailer;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            ['id' => $this->user->id]
        );

        $mail = $this
            ->subject(trans('mail.verify.subject'))
            ->introLines([
                trans('mail.verify.line')
            ])
            ->action(trans('mail.verify.action'), $verifyUrl)
            ->markdown('mails.default');

        Log::info("User #".$this->user->id." has requested an 'verify email' email.");

        return $mail;
    }
}
