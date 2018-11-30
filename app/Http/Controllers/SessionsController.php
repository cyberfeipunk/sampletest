<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
    //
    public function __construct(){
      $this->middleware(
        "guest",[
          'only' => ['create'],
        ]
      );
    }

    public function create(){
      if(Auth::check()){
        session()->flash('warning','已经登录过！请先退出！');
        $user = Auth::user();
        return redirect()->route('users.show',[$user]);
      }else{
        return view('sessions.create');
      }
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
          'email'=>'required|email|max:255',
          'password' => 'required'
        ]);
        if(Auth::attempt($credentials,$request->has('remember'))){
          $user = Auth::user();
          if($user->activated){
            session()->flash('success','欢迎，回来!'.$user->name);
            //return redirect()->route('users.show',$user);
            return redirect()->intended(route('users.show',[$user]));
          }else{
            Auth::logout();
            session()->flash('danger',"对不起您还没有进行邮箱确认！请先到您的个人邮箱中进行邮箱确认！<a href='".route('resendConfirmEmail',$user)."'>重新发送</a>");
            return redirect(route('home'));
          }



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
