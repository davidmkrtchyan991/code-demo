<?php

use \App\Utils\OrderUtils;

$percentagesGroup = OrderUtils::getOrdersPercentagesGroup();
$registeredPercent = OrderUtils::getPercentageForStatus($percentagesGroup, OrderStatusEnum::REGISTERED);
$assignedToTechManagerPercent = OrderUtils::getPercentageForStatus($percentagesGroup, OrderStatusEnum::ASSIGNED_TO_TECH_MANAGER);
$assignedToOptimizerPercent = OrderUtils::getPercentageForStatus($percentagesGroup, OrderStatusEnum::ASSIGNED_TO_OPTIMIZER);
$completedPercent = OrderUtils::getPercentageForStatus($percentagesGroup, OrderStatusEnum::COMPLETED);
?>
@extends('components.index')

@section('content')
    @if(auth()->user()->isClient())
        <br/>

        <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel tile overflow_hidden">
                    <div class="x_title">
                        <h2>@lang("order.all.statistics.label")</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @include("client.order-charts")
                </div>
            </div>

            @include("client.recent-history")

        </div>

    @endif
@endsection