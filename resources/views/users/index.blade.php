@extends('layouts.default')
@section('title','主页')

@section('content')
  <div class="jumbotron">
    <h1>用户列表</h1>

<table class="userList table">
  <thead>
    <tr>
      <th>头像</th><th>用户名</th><th>邮箱</th><th>查看</th>
    </tr>
  </thead>
  <tbody>
    @foreach($usersList as $user)
    <tr>
      <td><img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar"/></td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td><a href="{{ route('users.show',$user->id) }}">查看</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

    <a class="btn btn-lg btn-success" href="{{ route('users.create') }}" role="button">现在注册</a>

  </div>
@stop
