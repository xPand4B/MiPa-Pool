<?php

namespace App\Http\Controllers;

use App\Events\Profile\UpdateProfileDataEvent;
use App\Events\Profile\LoadProfileDataEvent;
use App\Events\Profile\ResetAvatarEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Restrict access
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $userData = event(new LoadProfileDataEvent())[0];

        return view('pages.profile.edit', [
            'user'                   => $userData['user'],
            'order_count'            => $userData['order_count'],
            'order_count_this_month' => $userData['this_month'],
            'money_spend'            => $userData['money_spend']
        ]);
    }

    /**
     * Resets the avatar to the default image.
     * 
     * @return \Illuminate\Http\Response
     */
    public function resetAvatar()
    {
        event(new ResetAvatarEvent());

        return redirect()->route('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        event(new UpdateProfileDataEvent($request));

        return redirect()->route('profile.edit');
    }
}
