{{--<br>--}}
{{--@if ($success)--}}
    {{--<div class="alert alert-success">--}}
        {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
        {{--<p>{{ $success }}</p>--}}
    {{--</div><br/>--}}
{{--@endif--}}
<hr>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Номер Заказа</th>
        <th>Компания</th>
        <th>Почта</th>
        <th>И.Ф.О.</th>
        <th>Домен</th>
        <th>Ном. дог.</th>
        <th>Тариф</th>
        <th>Статус</th>
        <th>Действие</th>
    </tr>
    </thead>
    <tbody>
    @foreach($filteredResults as $order)
        <tr>
            <td>{{$order['orderNumber']}}</td>
            <td>{{$order['companyName']}}</td>
            <td>{{$order['email']}}</td>
            <td>{{$order['userName']}}</td>
            <td>{{$order['domain']}}</td>
            <td>{{$order['offerNumber']}}</td>
            <td>@lang('tariff.'.$order->tariff['name'].'.label')</td>
            <td>@lang('order.status.'.$order->status.'.label')</td>
            <td><a href="{{action('OrderController@show', $order['id'])}}" class="btn btn-success">@lang("custom.show.label")</a></td>
        </tr>
    @endforeach
    </tbody>
</table>