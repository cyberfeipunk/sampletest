<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
class StatusesController extends Controller
{
    //
    public function list(){
      $statuses = Status::paginate(30);
      return view('statuses.list',compact(['statuses']));
    }
}
