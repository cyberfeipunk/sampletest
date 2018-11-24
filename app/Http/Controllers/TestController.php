<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
      $url = parse_url(getenv("DATABASE_URL"));
      return $url;
    }
}
