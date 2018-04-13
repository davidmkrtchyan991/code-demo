<div id="maintenances-tabs">

    @if(isset($order) && $order->hasChecklists())
        @include('admin.crud-orders.templates.checklists.checklists-by-order')
    @else
        @include('admin.crud-orders.templates.checklists.checklists-by-tariff')
    @endif

</div>
