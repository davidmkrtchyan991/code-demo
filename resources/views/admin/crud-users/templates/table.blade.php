<table class="table table-striped">
    <thead>
    <tr>
        <th>@lang('user.name.label')</th>
        <th>@lang('user.surname.label')</th>
        <th>@lang('user.email.label')</th>
        <th>@lang('user.role.label')</th>
        <th colspan="2">@lang('user.action.label')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user['name']}}</td>
            <td>{{$user['surname']}}</td>
            <td>{{$user['email']}}</td>
            <td>
                @lang('roles.'.$user->getCurrentRole()['name'].'.label')
            </td>
            <td><a href="{{action('UserController@edit', $user['id'])}}" class="btn btn-warning">@lang("custom.edit.label")</a></td>
            <td>
                @if($user['id'] !== Auth::user()->id )
                    <form action="{{action('UserController@destroy', $user['id'])}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">@lang("custom.delete.label")</button>
                    </form>
                @endif
            </td>

        </tr>
    @endforeach
    </tbody>
</table>