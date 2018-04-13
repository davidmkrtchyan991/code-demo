@if($user->isTechManager())
    <div class="form-group">
        <label for="role"
               class="col-md-2 control-label">@lang("checklist.change.statuses.label")</label>
        <div class="col-md-4">
            <select maintenance-id="{{$maintenance['id']}}"
                    class="form-control checklists-statuses-selector no-validation">
                <option value=""></option>
                <option value="{{\ChecklistItemStatusEnum::WAITING_TO_BE_ASSIGNED}}">{{\ChecklistItemStatusEnum::getTranslation(\ChecklistItemStatusEnum::WAITING_TO_BE_ASSIGNED)}}</option>
                <option value="{{\ChecklistItemStatusEnum::ASSIGNED}}">{{\ChecklistItemStatusEnum::getTranslation(\ChecklistItemStatusEnum::ASSIGNED)}}</option>
            </select>
        </div>
    </div>
@elseif($user->isOptimizer())
    <?php
    $hasAssignedItems = $checklistGroup->first(function ($checklist, $i1) {
        return $checklist->hasAlreadyAssignedItem() && !$checklist->allItemsCompleted();
    });
    ?>

    @if($hasAssignedItems)
        <div class="form-group">
            <label for="role"
                   class="col-md-4 control-label">@lang("checklist.change.statuses.label")</label>
            <div class="col-md-4">
                <select maintenance-id="{{$maintenance['id']}}"
                        class="form-control checklists-statuses-selector no-validation">
                    <option value=""></option>
                    <option value="{{\ChecklistItemStatusEnum::ASSIGNED}}">{{\ChecklistItemStatusEnum::getTranslation(\ChecklistItemStatusEnum::ASSIGNED)}}</option>
                    <option value="{{\ChecklistItemStatusEnum::DONE}}">{{\ChecklistItemStatusEnum::getTranslation(\ChecklistItemStatusEnum::DONE)}}</option>
                </select>
            </div>
        </div>
    @endif
@endif