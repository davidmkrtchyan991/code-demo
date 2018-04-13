@php($oldNameValue=isset($tariff)?$tariff->name:old('name'))
@php($oldPriceValue=isset($tariff)?$tariff->price:old('price'))
<div class="form-group">
    <label for="name" class="col-sm-1 control-label">@lang("custom.name.label")</label>
    <div class="col-sm-5">
        <input type="text" id="name" name="name" value="{{ $oldNameValue }}" required maxlength="500"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-1 control-label">@lang("tariff.price.label")</label>
    <div class="col-sm-5">
        <input type="number" id="price" name="price" value="{{ $oldPriceValue }}" required
               class="form-control">
    </div>
</div>

<hr>

<h4>@lang('maintenance.list.label')</h4>
<div class="form-inline">
    @foreach ($maintenances as $maintenance)
        <div class="col-sm-7 ">
            <input {{isset($tariff) && $tariff->hasMaintenance($maintenance)?"checked":""}} type="checkbox" id="maintenances[]"
                   name="maintenances[]" value="{{$maintenance['id']}}" class="maintenance-checkbox form-control">
            <input disabled="disabled" class="form-control" type="text"
                   value="{{$maintenance['name']}}" title="{{$maintenance['name']}}"/>
        </div>
    @endforeach
</div>
