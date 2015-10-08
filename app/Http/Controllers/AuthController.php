<?php
/**
 * Created by PhpStorm.
 * User: Matej
 * Date: 29. 8. 2015
 * Time: 0:01
 */

namespace Social\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Social\Models\User;

class AuthController extends Controller
{
    public function getSignup(){
        return view('auth.signup');
    }

    public function postSignup( Request $request){
        $this->validate($request,[
            'email'=> 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
        ]);

        User::Create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        notify()->flash('You are ready to go','success');
        return redirect()->route('home');
    }

    public function getSignin(){
        return view('auth.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only(['email','password'],$request->has('remember')))){
            notify()->flash('Could not sign you in with those information','warning');
            return redirect()->back();
        }

        notify()->flash('You are in FriendZone','success');
        return redirect()->route('home');

    }

    public function getSignOut(){
        Auth::logout();
        return redirect()->route('home');
    }
}