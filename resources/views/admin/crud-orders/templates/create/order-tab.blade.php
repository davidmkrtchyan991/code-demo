<div class="form-group">
    <label for="tariff" class="col-sm-1 control-label">Тарифный план</label>
    <div class="col-sm-9">

        <select name="tariff" id="tariff" class="form-control">
            <option value=""></option>
            @foreach ($tariffs as $tariff)
                <option
                        @if ($tariff['id'] == old('tariff'))
                        selected="selected"
                        @endif
                        value="{{$tariff['id']}}">{{$tariff['name']}}</option>
            @endforeach
        </select>
    </div>
</div> <!-- /.form-group -->

<div class="form-group">
    <label for="mobNumber" class="col-sm-1 control-label">Номер тел.*</label>
    <div class="col-sm-9">
        <input type="text" id="mobNumber" name="mobNumber" value="{{ old('mobNumber') }}" class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="companyName" class="col-sm-1 control-label">Название компании</label>
    <div class="col-sm-9">
        <input type="text" id="companyName" name="companyName" value="{{ old('companyName') }}" class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="domain" class="col-sm-1 control-label">Домен*</label>
    <div class="col-sm-9">
        <input type="text" id="domain" name="domain" value="{{ old('domain') }}" placeholder="URL address"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="additionalMobNumber" class="col-sm-1 control-label">Доп. номер тел.</label>
    <div class="col-sm-9">
        <input type="text" id="additionalMobNumber" name="additionalMobNumber" value="{{ old('additionalMobNumber') }}"
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="offerNumber" class="col-sm-1 control-label">Номер договора оферты*</label>
    <div class="col-sm-9">
        <input type="text" id="offerNumber" name="offerNumber" value="{{ old('offerNumber') }}" class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="startDate" class="col-sm-1 control-label">@lang('order.startDate.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='startDatePicker'>
        <input type='text' id="startDate" name="startDate"
               class="form-control" value="{{ old('startDate') }}"/>
        <span class="input-group-addon">
                        <span style="margin-bottom:0px" class="glyphicon glyphicon-calendar"></span>
                    </span>
    </div>
</div>

<div class="form-group">
    <label for="endDate" class="col-sm-1 control-label">@lang('order.endDate.label')</label>
    <div style="padding-right: 15px; padding-left: 15px;" class='input-group date col-sm-3' id='endDatePicker'>
        <input type='text' name="endDate" id="endDate" value="{{ old('endDate') }}"
               class="form-control"/>
        <span class="input-group-addon">
                        <span style="margin-bottom:0px" class="glyphicon glyphicon-calendar"></span>
                    </span>
    </div>
</div>

@include('admin.crud-orders.templates.create.ftp-details')

<div class="form-group">
    <label for="comment" class="control-label col-sm-1">Комментарий</label>
    <div class="col-sm-9">
        <textarea class="form-control" id="comment" name="comment">{{old('comment')}}</textarea>
    </div>
</div> <!-- /.form-group -->