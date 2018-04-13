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

    @php($operation=App\Utils\OrderUtils::getActionToPersist($order->status,$order->commitOperation))
    <form method="post" id="order-form"
          action="{{action('OrderController@'.$operation, $id)}}"
          class="form-horizontal" role="form">

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3 pull-right">
                <button type="submit"
                        class="btn btn-primary btn-block">@lang("order.operation.".$order->commitOperation.".label")</button>
            </div>
        </div>
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#user">@lang("custom.client.label")</a></li>
            <li><a data-toggle="tab" href="#order">@lang("custom.order.details.label")</a></li>
            @if(App\Utils\OrderUtils::isOptimizerTabVisible($order))
                <li><a data-toggle="tab"
                       href="#optimizer">@lang('roles.'.App\Classes\enums\RoleEnum::ROLE_OPTIMIZER.'.label')</a></li>

            @endif
            <li><a data-toggle="tab" href="#checklists">@lang("custom.order.checklists.label")</a></li>
            <li><a data-toggle="tab" href="#charts">@lang("custom.order.charts.label")</a></li>
            <li><a data-toggle="tab" href="#history">@lang("custom.order.history.label")</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="user">
                <br><br>
                @include('admin.crud-orders.templates.edit.user-tab')
            </div>

            <div class="tab-pane fade" id="order">
                <br><br>
                @include('admin.crud-orders.templates.edit.order-tab')
            </div>

            @if(App\Utils\OrderUtils::isOptimizerTabVisible($order))
                <div class="tab-pane fade" id="optimizer">
                    <br>
                    @include('admin.crud-orders.templates.edit.optimizer-tab')
                </div>
            @endif
            <div class="tab-pane fade" id="checklists">
                <br><br>
                @include('admin.crud-orders.templates.checklists.checklists-tab')
            </div>
            <div class="tab-pane fade" id="charts">
                <br><br>
                @include('admin.crud-orders.templates.charts')
            </div>
            <div class="tab-pane fade" id="history">
                <br><br>
                @include('admin.crud-orders.templates.history.history')
            </div>
        </div>
    </form>
    @include('admin.crud-orders.templates._hidden')
@endsection

