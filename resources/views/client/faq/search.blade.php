<form class="form-horizontal" method="POST" action="{{ action('HomeController@searchFaq') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="category" class="col-md-1 control-label">@lang('custom.category.label')</label>

        <div class="col-md-4">

            <select name="category" id="category" class="form-control">
                <option value=""></option>
                @foreach ($faqCategories->groupBy('category') as $faqCategory)
                    <option
                            @if ($faqCategory->first()->category == $request->get('category'))
                            selected="selected"
                            @endif
                            value="{{$faqCategory->first()->category}}">
                        {{$faqCategory->first()->category}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="question" class="col-md-1 control-label">@lang('custom.question.label')</label>

        <div class="col-md-4">
            <input id="question" type="text" class="form-control" name="question" value="{{$request->get('question')}}">
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