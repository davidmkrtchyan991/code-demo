@extends('components.index')

@section('content')
    <?php /**/
    $user = auth()->user() /**/ ?>
    <br>
    @include('admin.crud-orders.templates.domain-finder')
    <br>

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Компания</th>
            <th>Почта</th>
            <th>И.Ф.О.</th>
            <th>Домен</th>
            <th>Ном. дог.</th>
            <th>Статус</th>
            <th>Тариф</th>
            <th colspan="2">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{$order['id']}}</td>
                <td>{{$order['companyName']}}</td>
                <td>{{$order['email']}}</td>
                <td>{{$order['userName']}}</td>
                <td>{{$order['domain']}}</td>
                <td>{{$order['offerNumber']}}</td>
                <td class="{{strtolower($order->status)}}">@lang('order.status.'.$order->status.'.label')</td>
                <td>{{$order->tariff['name']}}</td>
                <td><a href="{{action('OrderController@show', $order['id'])}}"
                       class="btn btn-success">@lang("custom.show.label")</a></td>

                <td>
                    @foreach($order->operations as $opName =>$operation)
                        @if($user->hasAnyRole($operation['roles']))
                            <a href="{{action('OrderController@'.$operation['actionToGet'], $order['id'])}}"
                               class="btn btn-warning">@lang("order.operation.".$opName.".label")</a>
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection