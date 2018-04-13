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
    <form method="post" action="{{action('ChecklistController@update', $id)}}" class="form-horizontal">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="count" value="1"/>

        @include('admin.crud-checklists.templates.form-fields')
        @if(!$checklist->maintenance->isKeywords())
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3 pull-right">
                    <button type="submit" class="btn btn-primary btn-block">Обновить чеклист</button>
                </div>
            </div>
        @endif
    </form>
@endsection