<tr>
  <td><img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar"/></td>
  <td>{{ $user->name }}</td>
  <td>{{ $user->email }}</td>
  <td>
    <a href="{{ route('users.show',$user->id) }}">查看</a>
    <a href="{{ route('users.edit',$user->id) }}">编辑</a>
    @can('destroy',$user)
    <form action="{{ route('users.destroy',$user) }}" method="post">
      {{ method_field("delete") }}
      {{ csrf_field() }}
      <button type="submit" class="btn btn-sm delete-btn btn-danger">删除</button>
    </form>
    @endcan
  </td>


</tr>
