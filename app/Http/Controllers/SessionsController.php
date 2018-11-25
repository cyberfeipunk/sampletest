<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
    //

    public function create(){
      return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
          'email'=>'required|email|max:255',
          'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
          $user = Auth::user();
          session()->flash('success','欢迎，回来!'.$user->name);
          return redirect()->route('users.show',$user);
        }else{
          session()->flash('danger','邮箱密码验证失败');
          return redirect()->back();
        }

        return;
    }

    public function destroy(){
      Auth::logout();
      session()->flash('success','退出成功');
      return redirect('login');
    }
}
