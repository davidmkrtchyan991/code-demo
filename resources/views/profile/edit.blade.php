@extends('components.index')

@section('content')

    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Редактировать информацию</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <form method="post" action="{{action('ProfileController@update', $id)}}" id="demo-form2"
                              data-parsley-validate class="form-horizontal form-label-left">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="PATCH">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br/>
                            @endif
                            <hr>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Имя</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{$user->name}}" required>

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
                                    <input id="surname" type="text" class="form-control" name="surname"
                                           value="{{ $user->surname }}"
                                           required>

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
                                    <input id="email" type="email" class="form-control" disabled="disabled"
                                           name="email"
                                           value="{{$user->email}}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <a class="btn btn-info changeUserPassFieldsBtn">Изменить пароль</a>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first("password") }}</strong>
                                            </span>
                                @endif
                                <div class="changeUserPassFieldsBlock">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-primary" type="reset">Сбросить</button>
                                    <button type="submit" class="btn btn-primary">
                                        Обновить информацию
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection