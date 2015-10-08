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
            return redirect()
                ->route('home')
                ->with('info','User could not be found');
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
            return redirect()->route('profile.index',['username'=> $user->username])->with('info','Pending...');
        }

        if(Auth::user()->isFriendsWith($user)){
            return redirect()->route('profile.index',['username'=> $user->username])->with('info','You already friendzoned this person');
        }

        Auth::user()->addFriend($user);
        return redirect()->route('profile.index',['username'=>$username])->with('info','Friendzone request sent');
    }
}