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
    <form method="post" action="{{url('admin/maintenance')}}" id="maintenance-form" class="form-horizontal" role="form">
        {{csrf_field()}}


        @include('admin.crud-maintenance.templates.form-fields')

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3 pull-right">
                <button type="submit" class="btn btn-primary btn-block">@lang('custom.add.label')</button>
            </div>
        </div>
    </form>
@endsection