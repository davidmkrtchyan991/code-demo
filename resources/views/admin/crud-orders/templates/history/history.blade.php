@if(isset($history))
    <h2>@lang("checklist.history.label")</h2>
    <br><br>
    @foreach($history as $record)
        @include('admin.crud-orders.templates.history.operation-info')
        <br>
    @endforeach
@endif