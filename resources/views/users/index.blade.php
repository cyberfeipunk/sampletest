@extends('layouts.default')
@section('title','主页')

@section('content')
  <div class="jumbotron">
    <h1>用户列表</h1>
    <a href="{{ route('users.create') }}">注册</a>

  </div>
@stop
