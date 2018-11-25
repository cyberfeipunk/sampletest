<header class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <div class="col-md-offset-1 col-md-10">
      <a href="{{ route('home') }}" id="logo">中维世纪</a>
      <nav>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('help') }}">帮助</a></li>
          @if(Auth::check())
          <li>
            {{ Auth::user()->name }}
            <a href="#">
              <form action="{{route('logout')}}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
              </form>
            </a>
          </li>
          @else
          <li><a href="{{route('login')}}">登录</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </div>
</header>
