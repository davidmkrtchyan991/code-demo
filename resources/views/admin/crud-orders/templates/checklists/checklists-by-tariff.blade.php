@isset($checklistsGroup)

    <div class="form-group">
        <label for="role" class="col-md-4 control-label">@lang("checklist.picker.label")</label>

        <div class="col-md-4">
            <select name="checklists-selector" id="checklists-selector" class="form-control no-validation">
                <option value=""></option>
                @foreach ($checklistsGroup as $checklistGroup)
                    @php($maintenance=$checklistGroup->first()->maintenance)
                    <option value="{{$maintenance['id']}}">{{$maintenance->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <hr class="dark-hr">

    <div class="checklists-container">
        <br>
        @foreach ($checklistsGroup as $checklistGroup)
            @php($maintenance=$checklistGroup->first()->maintenance)

            <div style="display: none" class="tariff-checklist" id="checklists-for-maintenance-{{$maintenance['id']}}">
                @if($maintenance->isKeyWords())
                    <div class="form-group">
                        <div class="col-sm-9">
                            <br>
                            @include('components.maintenance-keywords-uploader')
                        </div>
                    </div>
                @else
                    @foreach($checklistGroup as $index=>$checklist)
                        <strong>@lang("checklist.default.label") - {{$index+1}}</strong>
                        @foreach($checklist->items as $item)
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            {{$item->name}}
                                        </label>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>

@endisset