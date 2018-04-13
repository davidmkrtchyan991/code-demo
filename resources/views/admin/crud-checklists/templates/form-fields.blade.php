<div class="form-group">
    <label for="maintenance" class="col-sm-3 control-label">Имя чеклиста</label>
    <div class="col-sm-7">
        <input type="text" disabled="disabled" name="maintenance" class="input form-control"
               value="{{$checklist->maintenance['name']}}"/>
    </div>
</div>
<hr>

<div class="form-group">
    <label for="tariff" class="col-sm-3 control-label">@lang("checklist.tariffs.label")</label>
    <div class="col-sm-7">
        <select data-placeholder="@lang("checklist.tariffs.label")" multiple name="tariff[]" id="tariff[]"
                class="chosen-select form-control" required>
            <option value=""></option>
            @foreach ($tariffs as $tariff)
                <option
                        @if($checklist->tariffs->firstWhere('id', $tariff->id))
                        selected="selected"
                        @endif
                        value="{{$tariff['id']}}">
                    {{$tariff['name']}}
                </option>
            @endforeach
        </select>
    </div>
</div>

<hr>
@foreach($checklist->items as $item )
    <input type="hidden" name="count" value="1"/>
    <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="controls" id="profs">
            <div class="col-sm-7"><br>
                <input autocomplete="off" class="input form-control" name="prop[]" type="text" placeholder=""
                       value="{{$item->name}}" data-items="8"/>
            </div>
        </div>
        <br>
    </div>
@endforeach

@if(!$checklist->maintenance->isKeywords())
    <div class="form-group" id="fields">
        <label class="col-sm-3 control-label" for="field1">Добавить поле</label>
        <div class="controls" id="profs">
            <div id="field" class="col-sm-7">
                <br>
                <input autocomplete="off" class="input form-control" id="field1" name="prop[]" type="text"
                       placeholder="" data-items="8"/>
                <button id="b1" class="btn add-more" type="button">+</button>
            </div>
        </div>
        <br>
    </div>
@endif