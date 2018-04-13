@php($isChecklistAssignable=\App\Utils\OrderUtils::isChecklistAssignable($order))
@if($isChecklistAssignable || $order->optimizer)
    <input id="findOptimizerURL" type="hidden" disabled="disabled"
           value="{{action('OrderController@findOptimizer')}}"/>
    <input typeof="text" name="optimizerId" id="optimizerId" type="hidden"
           value="{{$order->optimizer?$order->optimizer->id:''}}"/>
    <div class="form-group">
        <label for="optimizerToFind"
               class="col-sm-1 col-sm-offset-1 control-label">@lang('roles.'.App\Classes\enums\RoleEnum::ROLE_OPTIMIZER.'.label')</label>
        <div class="col-sm-3">
            <input type="text" id="optimizerToFind" autocomplete="off"
                   {{!$isChecklistAssignable?'disabled="disabled"':''}}
                   name="optimizerToFind" placeholder="@lang('custom.optimizer.finder.placeholder')"
                   value="{{$order->optimizer?$order->optimizer->email:""}}"
                   class="form-control">
            <div id="optimizers-suggesstion-box"></div>
        </div>
    </div>

    <div class="form-group">
        <label for="optimizerName"
               class="col-sm-1 col-sm-offset-1 control-label">Имя</label>
        <div class="col-sm-3">
            <input type="text" id="optimizerName" disabled="disabled" name="optimizerName"
                   value="{{$order->optimizer?$order->optimizer->name:""}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="optimizerSurname"
               class="col-sm-1 col-sm-offset-1 control-label">Фамилия</label>
        <div class="col-sm-3">
            <input type="text" id="optimizerSurname" disabled="disabled" name="optimizerSurname"
                   value="{{$order->optimizer?$order->optimizer->surname:""}}"
                   class="form-control">
        </div>
    </div>
@endif
<br>
<hr>