<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function index(){
      $usersList = User::all();
      //echo '<pre>';print_r($usersList);
      return view('users.index',compact('usersList'));
    }
    //
    public function create()
    {
        return view('users.create');
    }
    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function store(Request $request){
       $this->validate($request,[
         'name'=>'required|max:50',
         'email'=>'required|email|unique:users|max:255',
         'password'=>'required|confirmed|min:6'
       ]);
      $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password' => bcrypt($request->password)
      ]);
      session()->flash('success','欢迎，来到laravel!');
      //return redirect(route('users.show',[$user]));
      return redirect()->route("users.show",[$user]);
    }
}
