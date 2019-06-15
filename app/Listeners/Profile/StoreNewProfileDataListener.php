<?php

namespace App\Listeners\Profile;

use App\Events\SendFlashMessageEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Auth;

class StoreNewProfileDataListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $user = Auth::user();

        // Check if avatar has changed
        if(request()->hasFile('avatar')){
            request()->validate([
                'avatar' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048'
            ]);

            if($user->avatar != config('filesystems.avatar.default'))
                File::delete(config('filesystems.avatar.path') . $user->avatar);

            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

            request()->avatar->storeAs('avatars',$avatarName);

            User::findOrFail(Auth::user()->id)->update([
                'avatar' => $avatarName
            ]);
        }

        // Check if username has changed
        if(request('username') != $user->username){
            request()->validate([
                'username' => 'required|string|max:255'
            ]);
        }

        // Check if firstname has changed
        if(request('firstname') != $user->firstname){
            request()->validate([
                'firstname' => 'required|string|max:255'
            ]);
        }

        // Check if surname has changed
        if(request('surname') != $user->surname){
            request()->validate([
                'surname' => 'required|string|max:255'
            ]);
        }

        // Check if email has changed
        // if(request('email') != $user->email){
        //     request()->validate([
        //         'email' => 'required|email|max:255|unique:users'
        //     ]);
        // }

        // Check if password is set
        if(!empty(request('password'))){
            request()->validate([
                'password' => 'required|string|min:6|max:255|confirmed'
            ]);
            $user->password = Hash::make(request('password'));
        }

        // Validate no-required fields
        request()->validate([
            'about_me' => 'max:512'
        ]);

        User::findOrFail(Auth::user()->id)->update([
            'username'  => request('username'),
            'firstname' => request('firstname'),
            'surname'   => request('surname'),
            // 'email'     => request('email'),
            'about_me'  => request('about_me'),
        ]);

        event(new SendFlashMessageEvent('success', trans('session.profile.updated')));
    }
}
