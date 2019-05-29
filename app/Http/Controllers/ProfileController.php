<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Order;
use App\Menu;
use Session;
use Auth;

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
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();

        // 22670
        $money_spend = Menu::where('user_id', '=', $user->id)
                            ->sum('price');
        $money_spend *= 0.01;

        if($money_spend != '0'){
            if(strlen($money_spend) != 1){
                
                if($money_spend < 10){
                    $money_spend = '0'.$money_spend;
                }
                
                if(strlen($money_spend) == 4){
                    $money_spend = $money_spend.'0';
                }
            }
        }


        $order_count = Auth::user()->orders->count();

        $this_month = Order::where('user_id', '=', $user->id)
                            ->whereMonth('created_at', date('m'))
                            ->count();

        return view('pages.profile', [
            'user' => $user,
            'order_count' => $order_count,
            'order_count_this_month' => $this_month,
            'money_spend' => $money_spend
        ]);
    }

    /**
     * Resets the avatar to the default image.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function resetAvatar(Request $request)
    {
        if(Auth::user()->avatar == config('filesystems.avatar.default'))
            return redirect()->back();

        $user = Auth::user();

        $oldAvatar    = $user->avatar;
        $user->avatar = config('filesystems.avatar.default');
        
        $this->deleteAvatar($oldAvatar);

        $user->save();

        // Create success message
        Session::flash('success', trans('session.profile.resetedAvatar'));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request)
    {
        $user = Auth::user();

        // Check if avatar has changed
        if($request->hasFile('avatar')){
            $request->validate([
                'avatar' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048'
            ]);

            if($user->avatar != config('filesystems.avatar.default'))
                $this->deleteAvatar($user->avatar);

            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

            $request->avatar->storeAs('avatars',$avatarName);

            $user->avatar = $avatarName;
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

        $user->username  = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->surname   = $request->input('surname');
        $user->email     = $request->input('email');
        $user->aboutMe   = $request->input('aboutMe');
        $user->email     = $request->input('email');

        $user->save();

        // Create success message
        Session::flash('success', trans('session.profile.updated'));

        return redirect()->back();
    }

    /**
     * Deletes avatar based on filename.
     *
     * @param string $fileToDelete
     *
     * @return void
     */
    private function deleteAvatar(string $fileToDelete): void
    {
        File::delete(config('filesystems.avatar.path') . $fileToDelete);
    }
}
