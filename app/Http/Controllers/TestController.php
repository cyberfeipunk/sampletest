<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
class TestController extends Controller
{
    public function test(){
      var_dump(user::class);
    }
}
