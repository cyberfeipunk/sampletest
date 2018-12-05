<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Models\Status;
use App\Models\Users;

class StatusesController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
          'except' => ['']
        ]);
        $this->middleware(
            "guest",[
            'only' => [''],
          ]
        );
    }
    //
    public function index(Request $request){
      // $statuses = Status::orderBy('created_at','DESC')->paginate(10);
      // foreach ($statuses as $key => $status) {
      //     // code...
      //     $status->getUser();
      // }
      // $user = Auth::user();
      $feed_times = [];
      if(Auth::check()){
          if(!empty($request->user_id)){
              $user = User::find($request->user_id);
              $feed_items = $user->feed()->paginate(10);
          }else{
              $feed_items = $this->feed()->paginate(10);
          }

      }
     // var_dump($statuses->toArray());exit;
      return view('statuses.list',compact(['feed_items','user']));
    }

    public function store(Request $request){
        $this->validate($request, [
            'content' => 'required| max:140'
        ]);
        Auth::user()->statuses()->create([
            'content' => $request->content,
        ]);
        session()->flash('success','发布成功');
        return redirect()->back();
    }

    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }

    public function feed(){
        return Status::orderBy('created_at','DESC');
    }
}
