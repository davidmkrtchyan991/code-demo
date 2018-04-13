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

    <div class="col-xs-12 col-md-12">
        <h4>@lang("checklist.tariffs.label")</h4>
            @foreach($checklist->tariffs as $tariff)
                <div class="col-sm-7 col-sm-offset-1">
                    <input type="text" disabled="disabled" name="tariff" class="input form-control"
                           value="{{$tariff['name']}}"/>
                </div>
            @endforeach
        <br>
        <br>
        <table class="table" s>
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <strong>{{$checklist->maintenance['name']}}</strong>
                </th>
            </tr>
            </thead>
            <span style="display: none;">{{$i = 1}}</span>
            @foreach($checklist->items as $item )
                <tr>
                    <td colspan="5">{{$i++}}. {{$item->name}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection