<div class="stats">
    <a href="{{  route('followers.followings',$user->id) }}">
        <strong id="following" class="stat">
            {{  count($user->followings) }}
        </strong>
        关注
    </a>
    <a href="{{  route('followers.followers',$user->id) }}">
        <strong id="following" class="stat">
            {{  count($user->followers) }}
        </strong>
        粉丝
    </a>
    <a href="{{  route('statuses',['user_id'=>$user->id]) }}">
        <strong id="following" class="stat">
            {{  $user->statuses()->count() }}
        </strong>
        微博
    </a>
</div>