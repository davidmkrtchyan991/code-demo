<form class="form-horizontal" method="POST" action="{{ action('OrderController@search') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="order-domain" class="col-md-1 control-label">
            @lang('order.domain.label')
        </label>

        <div class="col-md-2">
            <input id="domain" value="{{app('request')->get('domain')}}" type="text" class="form-control" name="domain">
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">
                @lang('custom.find.label')
            </button>
        </div>
    </div>

    <br>
    <hr>
</form>
