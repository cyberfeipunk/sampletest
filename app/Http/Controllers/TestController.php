<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
class TestController extends Controller
{
    public function test(){
      return view('test.test');
    }
}
