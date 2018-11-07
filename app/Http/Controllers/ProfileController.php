<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
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

        return view('pages.profile')->withUser($user);
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
        Session::flash('success', 'Dein Profil wurde aktualisiert');

        return redirect()->back();
    }
}
