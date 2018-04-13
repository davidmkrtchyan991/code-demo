<div class="form-group">
    <label for="emailToFind" class="col-md-1 control-label">
        @lang('statistics.order.client.label')
    </label>

    <div class="col-md-2">
        <input type="text" value="{{$request->get('emailToFind')}}" id="emailToFind" name="emailToFind"
               autocomplete="off" placeholder="Ел. почта" class="form-control">
        <div id="users-suggesstion-box"></div>
    </div>
    <input id="findUserURL" type="hidden" disabled="disabled" value="{{action('OrderController@findUser')}}"/>
</div>

<div class="form-group">
    <label for="order-domain" class="col-md-1 control-label">
        @lang('statistics.order.domain.label')
    </label>

    <div class="col-md-2">
        <input id="order-domain" value="{{$request->get('order-domain')}}" type="text" class="form-control"
               name="order-domain">
    </div>
</div>
<br>
<hr>

<div class="form-group">
    <label for="order-status" class="col-md-1 control-label">
        @lang('statistics.order.status.label')
    </label>

    <div class="col-md-2">
        <select name="order-status" id="order-status" class="form-control">
            <option value=""></option>
            @foreach ($orderStatuses as $status)
                <option
                        @if ($status == $request->get('order-status'))
                        selected="selected"
                        @endif
                        value="{{$status}}">
                    @lang('order.status.'.$status.'.label')
                </option>
            @endforeach
        </select>
    </div>
</div>
<br>

<div class="form-group">
    <label for="order-tariff" class="col-md-1 control-label">
        @lang('statistics.order.tariff.label')
    </label>

    <div class="col-md-2">
        <select name="order-tariff" id="order-tariff" class="form-control">
            <option value=""></option>
            @foreach ($tariffs as $tariff)
                <option
                        @if ($tariff->id == $request->get('order-tariff'))
                        selected="selected"
                        @endif
                        value="{{$tariff->id}}">
                    {{$tariff->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>
<br>
<hr>
<div class="form-group">
    <label for="email" class="col-md-1 control-label">
        @lang('statistics.order.date.label')
    </label>
</div>

<div class="form-group">
    <label for="email" class="col-md-1 control-label">
        @lang('statistics.order.fromDate.label')
    </label>
    <div class="col-md-2">
        <input id="order-fromDate" value="{{$request->get('order-fromDate')}}" type="text" class="form-control"
               name="order-fromDate">
    </div>

    <label for="email" class="col-md-1 control-label">
        @lang('statistics.order.toDate.label')
    </label>

    <div class="col-md-2">
        <input id="order-toDate" value="{{$request->get('order-toDate')}}" type="text" class="form-control"
               name="order-toDate">
    </div>
</div>
