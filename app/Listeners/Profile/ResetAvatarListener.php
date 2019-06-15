<?php

namespace App\Listeners\Profile;

use App\Events\SendFlashMessageEvent;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Auth;

class ResetAvatarListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        if(Auth::user()->avatar == config('filesystems.avatar.default'))
            return redirect()->back();

        $oldAvatar = Auth::user()->avatar;

        File::delete(config('filesystems.avatar.path') . $oldAvatar);

        User::findOrFail(Auth::user()->id)->update([
            'avatar' => config('filesystems.avatar.default')
        ]);

        event(new SendFlashMessageEvent('success', trans('session.profile.resetedAvatar')));
    }
}
