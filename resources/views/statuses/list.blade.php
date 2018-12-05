@extends('layouts.default')
use App\Models\User;

@section('title','微博列表')

@section('content')
<div class="row">
      <div class="col-md-8">
        <section class="status_form">
          @include('statuses._status_form')
        </section>
        <h3>微博列表</h3>
        @include('statuses._feed')
      </div>
      <aside class="col-md-4">
        <section class="user_info">
          @include('shared._user_info', ['user' => Auth::user()])
        </section>
          <section>
              @include('users._stats',['user'=>Auth::user()])
          </section>
      </aside>
    </div>
@stop
