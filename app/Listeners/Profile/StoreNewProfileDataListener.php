<?php

namespace App\Listeners\Profile;

use App\Events\Profile\UpdateProfileDataEvent;
use App\Events\SendFlashMessageEvent;
use App\User;
use Auth;

class StoreNewProfileDataListener
{
    /**
     * Handle the event.
     *
     * @param  UpdateProfileDataEvent  $event
     * @return void
     */
    public function handle(UpdateProfileDataEvent $event)
    {
        $user    = Auth::user();
        $request = $event->request;

        // Check if avatar has changed
        if($request->hasFile('avatar')){
            $request->validate([
                'avatar' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048'
            ]);

            if($user->avatar != config('filesystems.avatar.default'))
                File::delete(config('filesystems.avatar.path') . $user->avatar);

            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

            $request->avatar->storeAs('avatars',$avatarName);

            User::where('id', '=', Auth::user()->id)->update([
                'avatar' => $avatarName
            ]);
        }

        // Check if username has changed
        if($request->input('username') != $user->username){
            $request->validate([
                'username' => 'required|string|max:255'
            ]);
        }

        // Check if firstname has changed
        if($request->input('firstname') != $user->firstname){
            $request->validate([
                'firstname' => 'required|string|max:255'
            ]);
        }

        // Check if surname has changed
        if($request->input('surname') != $user->surname){
            $request->validate([
                'surname' => 'required|string|max:255'
            ]);
        }

        // Check if email has changed
        if($request->input('email') != $user->email){
            $request->validate([
                'email' => 'required|email|max:255|unique:users'
            ]);
        }

        // Check if password is set
        if(!empty($request->input('password'))){
            $request->validate([
                'password' => 'required|string|min:6|max:255|confirmed'
            ]);
            $user->password = Hash::make($request->input('password'));
        }

        // Validate no-required fields
        $request->validate([
            'aboutMe' => 'max:512'
        ]);

        User::where('id', '=', Auth::user()->id)->update([
            'username' => $request->input('username'),
            'firstname' => $request->input('firstname'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'aboutMe' => $request->input('aboutMe'),
        ]);

        event(new SendFlashMessageEvent('success', trans('session.profile.updated')));
    }
}
