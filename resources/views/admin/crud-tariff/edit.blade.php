@extends('components.index')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    <form method="post" action="{{action('TariffController@update', $id)}}" id="tariff-form" class="form-horizontal" role="form">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">

        @include('admin.crud-tariff.templates.form-fields')

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3 pull-right">
                <button type="submit" class="btn btn-primary btn-block">@lang('custom.update.label')</button>
            </div>
        </div>
    </form>
@endsection