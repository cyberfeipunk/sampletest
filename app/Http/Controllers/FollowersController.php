<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
Use Auth;
class FollowersController extends Controller
{
    //

    public function store(User $user){
        $currentUser = Auth::user();
        if($currentUser->id === $user->id){
            return redirect('/');
        }
        if(!($currentUser->isFollowing($user->id))){
            $currentUser->follow($user->id);
        }
        return redirect()->back();
    }
    public function destroy(User $user){
        $currentUser = Auth::user();
        if($currentUser->id === $user->id){
            return redirect('/');
        }
        if($currentUser->isFollowing($user->id)){
            $currentUser->unfollow($user->id);
        }
        return redirect()->back();
    }

    public function followings(User $user){
        $users = $user->followings()->paginate(30);
        $title = '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user){
        $users = $user->followers()->paginate(30);
        $title = '粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }
}
