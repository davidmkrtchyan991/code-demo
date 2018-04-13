@extends('components.index')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    <form method="post" action="{{action('UserController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Имя</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
            <label for="surname" class="col-md-4 control-label">Фамилия</label>

            <div class="col-md-6">
                <input id="surname" type="text" class="form-control" name="surname" value="{{ $user->surname }}"
                       required
                       autofocus>

                @if ($errors->has('surname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">Ел. почта</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-xs-12">
            <a  class="btn btn-info changeUserPassFieldsBtn">Изменить пароль</a>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first("password") }}</strong>
                </span>
            @endif
            <div class="changeUserPassFieldsBlock">


            </div>
        </div>

        <div class="form-group">
            <label for="role" class="col-md-4 control-label">Роль</label>

            <div class="col-md-4">
                <select name="role" class="form-control" id="role">
                    <option value=""></option>
                    @foreach ($roles as $role)
                        <option
                                @if ($role['id'] == $user->getCurrentRole()['id']))
                                selected="selected"
                                @endif
                                value="{{$role['id']}}">@lang('roles.'.$role['name'].'.label')</option>
                    @endforeach
                </select>
                <br>

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Обновить информацию
                </button>
            </div>
        </div>
    </form>
@endsection