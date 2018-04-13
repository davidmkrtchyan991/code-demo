@extends('components.index')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    <form method="post" action="{{url('orders')}}" id="order-form" class="form-horizontal" role="form">
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3 pull-right">
                <button type="submit" class="btn btn-primary btn-block">Зарегистрировать</button>
            </div>
        </div>

        {{csrf_field()}}

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#user">@lang("custom.client.label")</a></li>
            <li><a data-toggle="tab" href="#order">@lang("custom.order.details.label")</a></li>
            <li><a data-toggle="tab" href="#checklists">@lang("custom.order.checklists.label")</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="user">
                <br><br>
                @include('admin.crud-orders.templates.create.user-tab')
            </div>

            <div class="tab-pane fade" id="order">
                <br><br>
                @include('admin.crud-orders.templates.create.order-tab')
            </div>

            <div class="tab-pane fade" id="checklists">
                <br><br>
                @include('admin.crud-orders.templates.checklists.checklists-tab')
            </div>
        </div>

    </form>
    @include('admin.crud-orders.templates._hidden')
@endsection