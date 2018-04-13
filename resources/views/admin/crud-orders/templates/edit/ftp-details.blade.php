<hr>
<br>

<h4>@lang('order.ftp.details.label')</h4>
<div class="form-group">
    <br>
    <label for="ftpHost" class="col-sm-1 control-label">@lang('order.ftpHost.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='ftpHost'>
        <input type='text' name="ftpHost" id="ftpHost" value="{{ $order && !old('ftpHost')?$order->ftpHost:old('ftpHost') }}"
               {{!$order->isEditable?'disabled="disabled"':''}}
               class="form-control"/>
    </div>
</div>

<div class="form-group">
    <label for="ftpPort" class="col-sm-1 control-label">@lang('order.ftpPort.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='ftpPort'>
        <input type='text' name="ftpPort" id="ftpPort" value="{{ $order&& !old('ftpPort')?$order->ftpPort:old('ftpPort') }}"
               {{!$order->isEditable?'disabled="disabled"':''}}
               class="form-control"/>
    </div>
</div>


<div class="form-group">
    <label for="ftpLogin" class="col-sm-1 control-label">@lang('order.ftpLogin.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='ftpLogin'>
        <input type='text' name="ftpLogin" id="ftpLogin" value="{{ $order&& !old('ftpLogin')?$order->ftpLogin:old('ftpLogin') }}"
               {{!$order->isEditable?'disabled="disabled"':''}}
               class="form-control"/>
    </div>
</div>


<div class="form-group">
    <label for="ftpPassword" class="col-sm-1 control-label">@lang('order.ftpPassword.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='ftpPassword'>
        <input type='text' name="ftpPassword" id="ftpPassword"
               value="{{$order&& !old('ftpPassword')?$order->ftpPassword: old('ftpPassword') }}"
               {{!$order->isEditable?'disabled="disabled"':''}}
               class="form-control"/>
    </div>
</div>

<div class="form-group">
    <label for="ftpCmsUrl" class="col-sm-1 control-label">@lang('order.ftpCmsUrl.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='ftpCmsUrl'>
        <input type='text' name="ftpCmsUrl" id="ftpCmsUrl"
               value="{{$order&& !old('ftpCmsUrl')?$order->ftpCmsUrl: old('ftpCmsUrl') }}"
               {{!$order->isEditable?'disabled="disabled"':''}}
               class="form-control"/>
    </div>
</div>

<div class="form-group">
    <label for="ftpCmsLogin" class="col-sm-1 control-label">@lang('order.ftpCmsLogin.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='ftpCmsLogin'>
        <input type='text' name="ftpCmsLogin" id="ftpCmsLogin"
               value="{{$order&& !old('ftpCmsLogin')?$order->ftpCmsLogin: old('ftpCmsLogin') }}"
               {{!$order->isEditable?'disabled="disabled"':''}}
               class="form-control"/>
    </div>
</div>

<div class="form-group">
    <label for="ftpCmsPassword" class="col-sm-1 control-label">@lang('order.ftpCmsPassword.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='ftpCmsPassword'>
        <input type='text' name="ftpCmsPassword" id="ftpCmsPassword"
               value="{{$order&& !old('ftpCmsPassword')?$order->ftpCmsPassword: old('ftpCmsPassword') }}"
               {{!$order->isEditable?'disabled="disabled"':''}}
               class="form-control"/>
    </div>
</div>

<br>
<hr>