<?php /**/

use \App\Classes\enums\ChecklistItemStatusEnum as ChecklistItemStatusEnum;
use App\Utils\ChecklistItemUtils as ChecklistItemUtils;

?>
<div class="form-group">
    <div class="col-sm-9">

        <div class="col-sm-1">
            @if($item->alreadyAssigned())
                <input style="float: left;" type="checkbox" disabled="disabled"
                       class="tariff-checkbox" checked>
            @endif
            <label class="col-sm-1">@lang('checklist.status.label')</label>
        </div>

        <div class="col-sm-2">
            @php($statusesConfig=ChecklistItemUtils::getStatusesConfig($item))
            @php($isItemEditable=ChecklistItemUtils::isItemEditable($order,$item))

            @if($isItemEditable)
                <select item-id="{{$item->id}}"
                        name="checklist-items-statuses[]"
                        id="checklist-items-statuses[]"
                        class="form-control checklist-item-status-selector">

                    @foreach ($statusesConfig->get('operations') as $status)
                        <option @if ($item->status == $status)
                                selected="selected"
                                @endif
                                id="{{$item->id}}-{{$status}}"
                                value="{{$item->id}}-{{$status}}">
                            @lang('checklist.item.status.'.$status.'.label')
                        </option>
                    @endforeach
                </select>
            @else
                <input disabled="disabled" class="form-control"
                       value="@lang('checklist.item.status.'.$statusesConfig->get('view').'.label')">
            @endif
        </div>

        <label>
            {{$item->name}}
        </label>
        <hr>
    </div>
</div>