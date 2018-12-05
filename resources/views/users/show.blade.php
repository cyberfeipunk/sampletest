@extends("layouts.default")
@section('title',$user->name)

@section('content')
<div class="row">
  <div class="col-md-offset-2 col-md-8">
    <div class="col-md-12">
      <div class="col-md-offset-2 col-md-8">
        <section class="user_info">
          @include('shared._user_info',['user'=>$user])
        </section>
        <section class="stats">
          @include('users._stats',['user'=>$user])
        </section>
        @if (Auth::check())
        <section>
          @include('users._follow_form',['user'=>$user])
        </section>
          @endif

      </div>
    </div>
  </div>
  <div class="col-md-12">
    <section>
      <h3>微博列表</h3>
      @include('statuses._feed',['feed_items'=>$feed_items])
    </section>
  </div>
</div>
@stop
