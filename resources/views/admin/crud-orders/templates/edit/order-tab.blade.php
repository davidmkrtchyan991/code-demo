<div class="form-group">
    <label for="tariff" class="col-sm-1 control-label">Тарифный план</label>
    <div class="col-sm-9">
        @if($order->isEditable)
            <select name="tariff" id="tariff" class="form-control">
                <option value=""></option>
                @foreach ($tariffs as $tariff)
                    <option
                            @if ($tariff['id'] == $order->tariff['id'])
                            selected="selected"
                            @endif
                            value="{{$tariff['id']}}">
                        {{$tariff['name']}}
                    </option>
                @endforeach
            </select>
        @else
            <input type="text" id="tariff"
                   disabled="disabled"
                   name="tariff" value="{{$order->tariff['name']}}" class="form-control">
        @endif
    </div>
</div> <!-- /.form-group -->

<div class="form-group">
    <label for="mobNumber" class="col-sm-1 control-label">Номер тел.*</label>
    <div class="col-sm-9">
        <input type="text" id="mobNumber"
               {{!$order->isEditable?'disabled="disabled"':''}}
               name="mobNumber" value="{{$order->mobNumber}}"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="companyName" class="col-sm-1 control-label">Название компании</label>
    <div class="col-sm-9">
        <input type="text" id="companyName"
               {{!$order->isEditable?'disabled="disabled"':''}}
               name="companyName" value="{{$order->companyName}}" class="form-control"
               autofocus>
    </div>
</div>

<div class="form-group">
    <label for="domain" class="col-sm-1 control-label">Домен*</label>
    <div class="col-sm-9">
        <input type="text" id="domain" name="domain"
               {{!$order->isEditable?'disabled="disabled"':''}}
               placeholder="URL address" value="{{$order->domain}}"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="additionalMobNumber" class="col-sm-1 control-label">Доп. номер тел.</label>
    <div class="col-sm-9">
        <input type="text" id="additionalMobNumber"
               {{!$order->isEditable?'disabled="disabled"':''}}
               name="additionalMobNumber" value="{{$order->additionalMobNumber}}"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="offerNumber" class="col-sm-1 control-label">Номер договора оферты*</label>
    <div class="col-sm-9">
        <input type="text" id="offerNumber"
               {{!$order->isEditable?'disabled="disabled"':''}}
               name="offerNumber" value="{{$order->offerNumber}}" class="form-control">
    </div>
</div>


<div class="form-group">
    <label for="startDate" class="col-sm-1 control-label">@lang('order.startDate.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3 datepicker'
         id='startDatePicker'>
        <input type='text' id="startDate" name="startDate" value="{{$order->startDate->format('d/m/Y')}}"
               class="form-control" {{!$order->isEditable?'disabled="disabled"':''}}/>
        <span class="input-group-addon">
                        <span style="margin-bottom:0px" class="glyphicon glyphicon-calendar"></span>
                    </span>
    </div>
</div>

<div class="form-group">
    <label for="endDate" class="col-sm-1 control-label">@lang('order.endDate.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='endDatePicker'>
        <input type='text' name="endDate" {{!$order->isEditable?'disabled="disabled"':''}} id="endDate"
               value="{{$order->endDate->format('d/m/Y')}}"
               class="form-control"/>
        <span class="input-group-addon">
                        <span style="margin-bottom:0px" class="glyphicon glyphicon-calendar"></span>
                    </span>
    </div>
</div>

@include('admin.crud-orders.templates.edit.ftp-details')

<div class="form-group">
    <label for="comment" class="control-label col-sm-1">Комментарий</label>
    <div class="col-sm-9">
        <textarea class="form-control"
                  {{!$order->isEditable?'disabled="disabled"':''}}
                  id="comment" name="comment">{{$order->comment}}</textarea>
    </div>
</div> <!-- /.form-group -->