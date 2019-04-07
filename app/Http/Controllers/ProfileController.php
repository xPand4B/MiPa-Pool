<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Menu;
use App\Order;
use App\User;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Check if avatar has changed
        if($request->hasFile('avatar')){
            $request->validate([
                'avatar' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048'
            ]);

            if($user->avatar != 'user.svg'){
                Storage::delete('avatars/'.$user->avatar);
            }

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
}
