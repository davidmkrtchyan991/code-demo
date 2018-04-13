@if($order->commitOperation==\App\Classes\enums\OrderOperationsEnum::ADD_EXCEPTIONAL_CHECKLIST)
    <div class="form-group" id="fields">
        <label class="col-sm-1 control-label" for="field1">Добавить поле</label>
        <div class="controls" id="profs">
            <div id="field" class="col-sm-8">
                <br>
                <input autocomplete="off" class="input form-control" id="field1" name="exceptional-items[]" type="text"
                       placeholder="" data-items="8"/>
                <button id="b1" class="btn add-more-exceptional" type="button">+</button>
            </div>
        </div>
        <br>
    </div>
@endif

@foreach($order->exceptionalChecklistItems as $item )
    <input type="hidden" name="count" value="1"/>
    <div class="form-group">
        <div class="controls" id="profs">
            <div class="col-sm-8"><br>
                <input autocomplete="off" class="input form-control" type="text" placeholder=""
                       value="{{$item->name}}" data-items="8" disabled="disabled"/>
            </div>
        </div>
        <br>
    </div>
@endforeach