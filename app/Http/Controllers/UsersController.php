<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UsersController extends Controller
{
    public function __construct(){
      $this->middleware('auth',[
        'except' => ['create','store','show','create']
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
        return view('users.show',compact('user'));
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
      session()->flash('success','欢迎，来到laravel!');
      Auth::login($user);
      //return redirect(route('users.show',[$user]));
      return redirect()->route("users.show",[$user]);
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
}
