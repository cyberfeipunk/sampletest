

<div class="col-md-offset-2 col-md-8">
  <ul class="nav nav-tabs">
    <li  class="{{ Request::is('/') ? 'active' : ''  }}"><a href="{{ route('home') }}">Home</a></li>
    <li class="{{ active_class(if_route('statuses')) }}"><a href="{{ route('statuses')}}">微博</a></li>
    @if(Auth::user())
    <li class="{{ Request::is('users*') ? 'active' : ''  }}"><a href="{{ route('users.show',Auth::user()) }}">个人信息</a></li>
    @endif
  </ul>
  <br>
</div>
