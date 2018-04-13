<?php

use \App\Utils\ChecklistItemUtils;

$percentagesGroup = ChecklistItemUtils::getItemsPercentagesGroup($order);
$waitingPercent = ChecklistItemUtils::getPercentageForStatus($percentagesGroup, ChecklistItemStatusEnum::WAITING_TO_BE_ASSIGNED);
$assignedPercent = ChecklistItemUtils::getPercentageForStatus($percentagesGroup, ChecklistItemStatusEnum::ASSIGNED);
$donePercent = ChecklistItemUtils::getPercentageForStatus($percentagesGroup, ChecklistItemStatusEnum::DONE);
?>

<div class="col-md-9 col-sm-9 col-xs-12">
    <div class="x_panel tile overflow_hidden">
        <div class="x_title">
            <h2>@lang("order.charts.details.label")</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="" style="width:100%">
                <tr>
                    <th style="width:37%;">
                        <p></p>
                    </th>
                    <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <p class="">@lang("checklist.status.label")</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <p style="text-align: center" class="">@lang("custom.progress.label")</p>
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
                                        <i class="fa fa-square red"></i>
                                        @lang("checklist.item.status.".ChecklistItemStatusEnum::WAITING_TO_BE_ASSIGNED.".label")
                                    </p>
                                </td>
                                <td>{{$waitingPercent}}%</td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                        <i class="fa fa-square blue"></i>
                                        @lang("checklist.item.status.".ChecklistItemStatusEnum::ASSIGNED.".label")
                                    </p>
                                </td>
                                <td>{{$assignedPercent}}%</td>
                            </tr>
                            <tr>
                                <td>
                                    <p><i class="fa fa-square green"></i>
                                        @lang("checklist.item.status.".ChecklistItemStatusEnum::DONE.".label")
                                    </p>
                                </td>
                                <td>{{$donePercent}}%</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


<script>
    window.onload = function () {
        $(document).ready(function () {
            window.orderChecklistsChart = {
                labels: [
                    "{{ChecklistItemStatusEnum::getTranslation(ChecklistItemStatusEnum::WAITING_TO_BE_ASSIGNED)}}", "{{ChecklistItemStatusEnum::getTranslation(ChecklistItemStatusEnum::ASSIGNED)}}",
                    "{{ChecklistItemStatusEnum::getTranslation(ChecklistItemStatusEnum::DONE)}}"
                ],
                datasets: [{
                    data: [{{$waitingPercent}}, {{$assignedPercent}}, {{$donePercent}}],
                    backgroundColor: [
                        "#E74C3C",
                        "#3498DB",
                        "#26B99A",
                    ]
                }]
            };
            init_chart_doughnut();
        });
    };
</script>
<input type="hidden" disabled="disabled" id="isOrderChecklistsChart" value="true"/>