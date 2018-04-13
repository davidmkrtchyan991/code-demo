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
            <th>@lang("custom.name.label")</th>
            <th>@lang("tariff.price.label")</th>
            <th colspan="2">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tariffs as $tariff)
            <tr>
                <td>{{$tariff['name']}}</td>
                <td>{{$tariff['price']}}</td>
                <td>
                    <a href="{{action('TariffController@edit', $tariff['id'])}}"
                       class="btn btn-warning col-md-2">@lang("custom.edit.label")</a>
                    <form action="{{action('TariffController@destroy', $tariff['id'])}}" method="post"
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
@endsection