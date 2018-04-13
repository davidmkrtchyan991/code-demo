@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br/>
@endif

<form class="form-horizontal" method="POST" action="{{ action('StatisticsController@filter') }}">
    {{ csrf_field() }}

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#order">@lang("statistics.order.label")</a></li>
        {{--<li><a data-toggle="tab" href="#client">@lang("statistics.client.label")</a></li>--}}
    </ul>

    <div class="tab-content  {{request()->get('activeTab')!='order'?"disabled-tab":""}}">
        <div class="tab-pane fade in active" id="order">
            <br><br>
            @include('admin.statistics.templates.tabs.order-tab')
        </div>

        {{--<div class="tab-pane fade {{request()->get('activeTab')!='client'?"disabled-tab":""}}" id="client">--}}
            {{--<br><br>--}}
            {{--@include('admin.statistics.templates.tabs.client-tab')--}}
        {{--</div>--}}
    </div>

    @include('admin.statistics.templates.hidden')
    <br>
    <br>
    <hr>
    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                @lang('custom.filter.label')
            </button>
        </div>
    </div>

</form>
