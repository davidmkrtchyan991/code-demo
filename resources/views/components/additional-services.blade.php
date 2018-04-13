<?php
$additionalMaintenances = \App\Maintenance::additionals()->get();
?>
@if($additionalMaintenances->count()>0)
    <div class="row" style="margin-bottom: 50px; border: 1px solid #E6E9ED; padding-bottom: 15px; ">

        <div class="x_title">
            <h2>Дополнительные услуги</h2>
            <div class="clearfix"></div>
        </div>
        @foreach($additionalMaintenances as $maintenance)
        <div class="col-md-4 col-sm-12 col-xs-12 text-center">
            <span class="count_top"><i class="fa fa-search"></i> {{$maintenance->name}}</span>
            <img src="/images/{{strtolower($maintenance->name)}}.jpg" alt="" style="max-width: 100%; height: 150px; display: block; margin: 0 auto;">
        </div>
        @endforeach
    </div>
@endif