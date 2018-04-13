<span>
    <b>{{$record->created_at->timezone('Europe/Moscow')->format('d/m/Y H:i:s')}}</b> :
    @lang("order.history.operation.done.message",
    ['role'=>\Lang::get("roles.{$record->user->getCurrentRole()->name}.label"),
    'name'=>$record->user->name,
    'operation'=>\Lang::get("order.operation.{$record->operation}.label")])
</span>

<br>
@if($record->checklistHistory->count()>0)
    <h3 style="margin-left: 15px">@lang('checklist.item.history.label')</h3>
    <br>
    <div style="margin-left: 15px">
        @foreach($record->checklistHistory as $checklistHistoryRecord)
            <span>
            @lang("checklist.item.history.record.message",
            ['name'=>$checklistHistoryRecord->itemName,
            'status'=>\Lang::get("checklist.item.status.{$checklistHistoryRecord->newStatus}.label")
            ])
        </span><br>
        @endforeach
    </div>
@endif
<hr style="height:1px;border:none;color:gray;background-color:gray;">