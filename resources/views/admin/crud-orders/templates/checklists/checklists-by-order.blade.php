<?php /**/

$user = auth()->user();
$groupedChecklists = $order->checklists->groupBy('maintenance.id');
/**/ ?>
@php($isChecklistAssignable=isset($order) && \App\Utils\OrderUtils::isChecklistAssignable($order))
<ul class="nav nav-tabs">
    <li class="active">
        <a data-toggle="tab" href="#checklists-container">
            @lang("custom.order.checklists.label")
        </a>
    </li>
    <li>
        <a data-toggle="tab" href="#exceptional-checklist">
            @lang("checklist.exceptional.label")
        </a>
    </li>
    <li>
        <a data-toggle="tab" href="#client-keywords-tab">
            @lang("custom.keywords.additional.label")
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade in active checklists-container" id="checklists-container">
        <br>
        <br>
        <div class="form-group">
            <label for="role" class="col-md-4 control-label">@lang("checklist.picker.label")</label>
            <div class="col-md-4">
                <select name="checklists-selector" id="checklists-selector" class="form-control no-validation">
                    <option value=""></option>
                    @foreach ($groupedChecklists as $checklistGroup)
                        @php($maintenance=$checklistGroup->first()->maintenance)
                        <option value="{{$maintenance['id']}}">{{$maintenance->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr class="dark-hr">
        <br>
        <br>
        @foreach ($groupedChecklists as $checklistGroup)
            @php($maintenance=$checklistGroup->first()->maintenance)
            <div style="display: none" class="tariff-checklist"
                 id="checklists-for-maintenance-{{$maintenance['id']}}">

                @if($maintenance->isKeyWords())
                    <div class="form-group">
                        <div class="col-sm-9">
                            <br>
                            @include('components.maintenance-keywords-uploader')
                        </div>
                    </div>
                @else
                    @include("admin.crud-orders.templates.checklists.checklists-item-status-selector")
                    @foreach($checklistGroup as $checklist)
                        @if($checklist->maintenance->id==$maintenance->id)
                            @foreach($checklist->items as $item)
                                @include("admin.crud-orders.templates.checklists.checklist-items")
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
    <div class="tab-pane exceptional-checklist fade" id="exceptional-checklist">
        @include("admin.crud-orders.templates.checklists.exceptional-checklists")
    </div>
    <div class="tab-pane fade" id="client-keywords-tab">
        @include('components.clients-keywords-uploader')
    </div>
</div>