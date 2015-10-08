<?php
/**
 * Created by PhpStorm.
 * User: Matej
 * Date: 29. 8. 2015
 * Time: 16:55
 */


namespace Social\Http\Controllers;

use Auth;
use Social\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getIndex(){

        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('friends.index')
            ->with('friends',$friends)
            ->with('requests',$requests);
    }

    public function getAdd($username){
        $user = User::where('username',$username)->first();

        if(!$user){
            notify()->flash('User could not be found','warning',['timer'=> 2000]);
            return redirect()
                ->route('home');
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){

            return redirect()->route('profile.index',['username'=> $user->username])->with('info','Pending...');
        }

        if(Auth::user()->isFriendsWith($user)){
            notify()->flash('You already friendzoned this person','info');
            return redirect()->route('profile.index',['username'=> $user->username]);
        }

        Auth::user()->addFriend($user);
        notify()->flash('Friendzone request sent','success');
        return redirect()->route('profile.index',['username'=>$username]);
    }
}