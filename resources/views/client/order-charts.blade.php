<div class="x_content">
    <table class="" style="width:100%">
        <tr>
            <th style="width:37%;">
            </th>
            <th>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <p class="">@lang("order.status.label")</p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <p class="" style="text-align: right">@lang("custom.progress.label")</p>
                </div>
            </th>
        </tr>
        <tr>
            <td>
                <canvas class="canvasDoughnut" height="140" width="140"
                        style="margin: 15px 10px 10px 0"></canvas>
            </td>
            <td>
                <table class="tile_info">
                    <tr>
                        <td>
                            <p>
                                <i class="fa fa-square red"></i>{{OrderStatusEnum::getTranslation(OrderStatusEnum::REGISTERED)}}
                            </p>
                        </td>
                        <td>{{$registeredPercent}}%</td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <i class="fa fa-square blue"></i>{{OrderStatusEnum::getTranslation(OrderStatusEnum::ASSIGNED_TO_TECH_MANAGER)}}
                            </p>
                        </td>
                        <td>{{$assignedToTechManagerPercent}}%</td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <i class="fa fa-square purple"></i>{{OrderStatusEnum::getTranslation(OrderStatusEnum::ASSIGNED_TO_OPTIMIZER)}}
                            </p>
                        </td>
                        <td>{{$assignedToOptimizerPercent}}%</td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <i class="fa fa-square green"></i>{{OrderStatusEnum::getTranslation(OrderStatusEnum::COMPLETED)}}
                            </p>
                        </td>
                        <td>{{$completedPercent}}%</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>


<script>
    window.onload = function () {
        $(document).ready(function () {
            window.ordersChart = {
                labels: [
                    "{{OrderStatusEnum::getTranslation(OrderStatusEnum::REGISTERED)}}", "{{OrderStatusEnum::getTranslation(OrderStatusEnum::ASSIGNED_TO_TECH_MANAGER)}}",
                    "{{OrderStatusEnum::getTranslation(OrderStatusEnum::ASSIGNED_TO_OPTIMIZER)}}", "{{OrderStatusEnum::getTranslation(OrderStatusEnum::COMPLETED)}}"
                ],
                datasets: [{
                    data: [{{$registeredPercent}}, {{$assignedToTechManagerPercent}}, {{$assignedToOptimizerPercent}}, {{$completedPercent}}],
                    backgroundColor: [
                        "#E74C3C",
                        "#3498DB",
                        "#9B59B6",
                        "#26B99A",
                    ]
                }]
            };
            init_chart_doughnut();
        });
    };
</script>
<input type="hidden" disabled="disabled" id="isOrdersChart" value="true"/>