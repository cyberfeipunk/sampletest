@extends('layouts.default')
@section('title','主页')

@section('content')

  <div class="jumbotron">
    <h1>用户列表</h1>
    <a class="btn btn-lg btn-success" href="{{ route('users.create') }}" role="button">现在注册</a>


<table class="userList table">
  <thead>
    <tr>
      <th>头像</th><th>用户名</th><th>邮箱</th><th>操作</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    @include('users._user')
    @endforeach
  </tbody>
</table>
    {!! $users->render() !!}

  </div>
@stop
