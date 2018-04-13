@extends('components.index')

@section('content')
    @include('components.success-message')
    <hr>
    <div>
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Имя</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required
                       disabled="disabled">
            </div>
        </div>

        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
            <label for="surname" class="col-md-4 control-label">Фамилия</label>

            <div class="col-md-6">
                <input id="surname" type="text" class="form-control" name="surname" value="{{ $user->surname }}"
                       required
                       disabled="disabled">

            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">Ел. почта</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" disabled="disabled" name="email"
                       value="{{$user->email}}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

    </div>
@endsection