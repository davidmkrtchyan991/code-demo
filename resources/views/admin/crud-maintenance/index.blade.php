@extends('components.index')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th colspan="2">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($maintenances as $maintenance)
            <tr>
                <td>{{$maintenance['name']}}</td>
                <td>
                    @if($maintenance->isKeywords)
                        <a href="{{action('MaintenanceController@editKeywords', $maintenance['id'])}}"
                           class="btn btn-warning col-md-2">@lang("custom.edit.label")</a>
                    @else
                        <a href="{{action('MaintenanceController@edit', $maintenance['id'])}}"
                           class="btn btn-warning col-md-2">@lang("custom.edit.label")</a>
                    @endif
                    <form action="{{action('MaintenanceController@destroy', $maintenance['id'])}}" method="post"
                          class="col-md-1">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">@lang("custom.delete.label")</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $maintenances->links() }}
@endsection