@php($oldValue=isset($maintenance)?$maintenance->name:old('name'))
<div class="form-group">
    <label for="name" class="col-sm-1 control-label">@lang("custom.name.label")</label>
    <div class="col-sm-5">
        <input type="text" id="name" name="name" value="{{ $oldValue }}" required maxlength="500"
               class="form-control">
    </div>
</div>