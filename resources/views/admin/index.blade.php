@extends('components.index')

@section('content')

    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Клиентов</span>
            <div class="count">{{$usersAmount}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i>Активные Заказы</span>
            <div class="count green">{{$ordersActiveAmount}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Завершенные</span>
            <div class="count">{{$ordersCompletedAmount}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-edit"></i> Базовый</span>
            <div class="count">{{$ordersBasicAmount}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-edit"></i> Средний</span>
            <div class="count">{{$ordersMediumAmount}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-edit"></i> Про</span>
            <div class="count">{{$ordersProAmount}}</div>
        </div>
    </div>
    <!-- /top tiles -->
    <br/>


@endsection