@if(isset($order))
    <div class="col-sm-4">
        <label>@lang('custom.base.label'), @lang('custom.count.label'): {{\App\Utils\OrderUtils::getOrderKeywordsCount($order)}}</label>
    </div>
@endif
<textarea name="keywords" id="keywords" rows="15"
          {{!isset($order) || !$order->isAssignChecklist ?'disabled="disabled"':''}}
          placeholder="@lang("custom.keywords.placeholder")"
          class="form-control no-validation">{{isset($order)? $order->keywords:''}}</textarea>