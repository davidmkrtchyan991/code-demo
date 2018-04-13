<form class="form-horizontal" method="POST" action="{{ action('UserController@searchClient') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="email" class="col-md-1 control-label">Email</label>

        <div class="col-md-4">
            <input id="email" type="text" class="form-control" name="email" value="{{$request->get('email')}}">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Search
            </button>
        </div>
    </div>

</form>