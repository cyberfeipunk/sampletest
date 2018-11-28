<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
          session()->flash('danger','中间件CheckAge输出请先登录！');
          return redirect()->back();
        }else{
          $user = Auth::user();
          if($user->age < 18 ){
            session()->flash('danger','未满意18岁不能修改信息！');
            return redirect()->back();
          }
        }
        return $next($request);
    }
}
