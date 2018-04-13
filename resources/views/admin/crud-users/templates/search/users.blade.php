<form class="form-horizontal" method="POST" action="{{ action('UserController@search') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="name" class="col-md-1 control-label">@lang('user.name.label')</label>

        <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="name" value="{{ $request->get('name') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="surname" class="col-md-1 control-label">@lang('user.surname.label')</label>

        <div class="col-md-4">
            <input id="surname" type="text" class="form-control" name="surname" value="{{ $request->get('surname') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-md-1 control-label">@lang('user.email.label')</label>

        <div class="col-md-4">
            <input id="email" type="text" class="form-control" name="email" value="{{ $request->get('email') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-md-1 control-label">@lang('user.role.label')</label>

        <div class="col-md-4">
            <select name="role" id="role" class="form-control">
                <option value=""></option>
                @foreach ($roles as $role)
                    <option
                            @if ($role['id'] == $request->get('role'))
                            selected="selected"
                            @endif
                            value="{{$role['id']}}">@lang('roles.'.$role['name'].'.label')</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                @lang("custom.find.label")
            </button>
        </div>
    </div>

</form>