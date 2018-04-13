@php($oldNameValue=isset($maintenance)?$maintenance->name:old('name'))
@php($oldCountValue=isset($maintenance)?$maintenance->keywords_count:old('keywords_count'))
<div class="form-group">
    <label for="name" class="col-sm-1 control-label">@lang("custom.name.label")</label>
    <div class="col-sm-5">
        <input type="text" id="name" name="name" value="{{ $oldNameValue }}" required maxlength="500"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-1 control-label">@lang("custom.count.label")</label>
    <div class="col-sm-5">
        <input type="number" id="keywords_count" name="keywords_count" value="{{ $oldCountValue }}" required maxlength="15"
               class="form-control">
    </div>
</div>