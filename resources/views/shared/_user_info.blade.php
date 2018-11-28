<a href="{{ route('users.show',$user->id) }}">
  <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar"/>
  </a>
  <h1>{{ $user->name }}</h1>

  <a href="{{ route('users.edit',$user->id) }}"><button class="btn btn-block btn-default">编辑个人信息</button></a>
