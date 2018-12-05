<header class="navbar navbar-fixed-top navbar-inverse" id="header">
  <div class="container">
    <div class="col-md-offset-1 col-md-10">
      <a href="{{ route('home') }}" id="logo">中维世纪</a>
      <nav>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('help') }}">帮助</a></li>
          @if(Auth::check())
          <li class="dropdown">
            <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
              {{ Auth::user()->name }}<b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              @if(Auth::user()->can('list',Auth::user()))
              <li><a href="{{ route('users.index') }}">用户列表</a></li>
              @endif
              <li><a href="{{ route('users.show',Auth::user()) }}">个人中心</a></li>
              <li><a href="{{ route('users.edit',Auth::user()) }}">编辑资料</a></li>
              <li class="divider"></li>
              <li>
                <a href="#" id="logout">
                  <form action="{{route('logout')}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                  </form>
                </a>
              </li>
            </ul>
          </li>

          @else
          <li><a href="{{route('login')}}">登录</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </div>
</header>
