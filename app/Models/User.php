<?php

namespace App\Models;

use App\Mail\Auth\ResetPasswordMail;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Events\SendFlashMessageEvent;
use App\Mail\Auth\EmailVerificationMail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Translation\HasLocalePreference;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname', 'surname', 'email', 'about_me', 'avatar', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Set user to many orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Set user to many menus
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this->locale;
    }

    /**
     * Get the user's fullname
     *
     * @return string
     */
    public function getFullnameAttribute(): string
    {
        return "$this->firstname $this->surname";
    }

    /**
     * Rather or not the current user has orders.
     *
     * @return boolean
     */
    public function hasOrders(): bool
    {
        $hasOrders = Order::where('user_id', $this->id)->count();

        if($hasOrders != 0)
            return true;

        return false;
    }

    /**
     * Rather or not the current user has menus.
     *
     * @return boolean
     */
    public function hasMenus(): bool
    {
        $hasMenus = Menu::where('user_id', $this->id)->count();

        if($hasMenus != 0)
            return true;

        return false;
    }

    /**
     * Re-send the email verification email.
     *
     * @return void
     */
    public function sendEmailVerificationNotification(): void
    {
        Mail::to($this)
            ->send(new EmailVerificationMail($this));

        event(new SendFlashMessageEvent('success', trans('login.verify.new_link_send')));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)
            ->send(new ResetPasswordMail($this, $token));

        event(new SendFlashMessageEvent('success', trans('passwords.sent')));
    }
}
