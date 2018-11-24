<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
      var_dump(getenv('IS_IN_HEROKU'));
      $url = parse_url(getenv("DATABASE_URL"));
      return $url;
    }
}
