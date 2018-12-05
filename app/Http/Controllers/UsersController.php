<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;
class UsersController extends Controller
{
    public function __construct(){
      $this->middleware('auth',[
        'except' => ['create','store','show','create','confirmEmail','resendConfirmEmail']
      ]);
      $this->middleware(
        "guest",[
          'only' => ['create'],
        ]
      );
      //$this->middleware('App\Http\Middleware\CheckAge',[
      //  'only' => ['edit'],
      //]);
    }
    public function index(){
      // Auth::check();
      // if(Auth::user()->cant('list',Auth::user())){
      //   session()->flash('danger','您无权浏览');
      //   return redirect()->back();
      // }
      //$users = User::all();
      $users = User::paginate(10);
      //echo '<pre>';print_r($usersList);
      return view('users.index',compact('users'));
    }


    //
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user){
        $feed_items = [];
        //$feed_items = $user->feed();
        $feed_items = $user->feed()->paginate(10);
        return view('users.show',compact('user','feed_items'));
    }

    public function store(Request $request){
       $this->validate($request,[
         'name'=>'required|max:50',
         'email'=>'required|email|unique:users|max:255',
         'password'=>'required|confirmed|min:6',
         'age' => 'numeric'
       ]);
      $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'age'=>$request->age,
        'password' => bcrypt($request->password)
      ]);
      session()->flash('success',"欢迎，来到laravel!请进入您的邮箱确认邮箱完成注册！");
      //Auth::login($user);
      //return redirect(route('users.show',[$user]));
      $this->sendEmailConfirmationTo($user);
      return redirect()->route("home");
    }

    public function edit(User $user){

      //$this->authorize('update',$user);
      if(Auth::user()->cant('update',$user)){
        session()->flash('danger','您无权修改别人的信息！');
        return redirect()->back();
      }

      return view('users.edit',compact('user'));
    }



    public function update(User $user,Request $request){
      $this->validate($request,[
        //'email'=>'required|email|unique:users|max:255',
        'name'=>'required|max:50',
        'password'=>'required|confirmed|min:6|max:50',
        //'password'=>'nullable|confirmed|min:6|max:50',
        'age' => 'numeric'
      ]);
      //调用授权策略UserPolicy
      if(Auth::user()->cant('update',$user)){
        session()->flash('danger','您无权修改别人的信息！');
        return redirect()->back();
      }
      //$this->authorize('update',$user);
      $user->update([
        'name'=>$request->name,
        'password'=>bcrypt($request->password),
        'age' => $request->age,
      ]);
      session()->flash('success','用户信息修改成功！');

      return redirect()->route('users.show',$user->user_id);
    }

    public function destroy(User $user){

      //$this->authorize('destroy',$user);
      if(Auth::user()->cant('destroy',$user)){
        session()->flash('danger','成功删除用户！');
        return back();
      }
      $user->delete();

      session()->flash('success','成功删除用户！');
      return back();
    }

    public function confirmEmail($token){

      $user = User::where(['activation_token'=>$token])->firstorfail();
      if($user){
        if($user->activated){
          session()->flash('warning','您的账号已经激活不需要再次激活!');
          return redirect()->route('home');
        }else{
          $user->activated = 1;
          $user->save();
          //$result = $user->update(['activated'=>true,'aa'=>'3']);
          session()->flash('success','激活成功，欢迎您来到Sample!');
          Auth::login($user);
          return redirect()->route('home');
        }
      }else{
        session()->flash('danger','请不要瞎搞!');
        return redirect()->route('home');
      }

    }







    public function resendConfirmEmail($user){
      $user = User::find($user);
      if(empty($user)){
        session()->flash('danger','未找到客户！');
        redirect(route('home'));
      }
      $this->sendEmailConfirmationTo($user);
      session()->flash('success','确认邮件发送成功！请尽快前往注册邮箱进行确认');
      return redirect()->route('home');
    }


    protected function sendEmailConfirmationTo($user){
      $view = 'emails.confirm';
      $data = compact('user');
      $from = '457286213@qq.com';
      $name = 'Sample';
      $to = $user->email;
      $subject = "感谢您注册Sample应用，请确认你的邮箱！";
       Mail::send($view,$data,function($message)use($from,$name,$to,$subject){
         $message->from($from,$name)->to($to)->subject($subject);
       });
    }






}
