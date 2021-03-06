@if($user->id !== Auth::user()->id)
    <div id="follow_form">
        @if(Auth::user()->isFollowing($user->id))
            <form action="{{ route('followers.destroy',$user->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit">取消关注</button>
            </form>
        @else
            <form action="{{ route('followers.store',$user->id) }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="but but-default">关注</button>
            </form>
        @endif
    </div>
@endif