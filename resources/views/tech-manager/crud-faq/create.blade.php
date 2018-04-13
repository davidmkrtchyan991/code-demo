@extends('components.index')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    <form method="post" action="{{url('manager/faq')}}" class="form-horizontal input-append" role="form">
        {{csrf_field()}}
        <div class="form-group">
            <label for="categoryFaq" class="col-sm-2 control-label">Категория</label>
            {{--<div class="col-sm-9">--}}
                {{--<select name="categoryFaq" id="categoryFaq" class="form-control">--}}
                    {{--@foreach($faqs as $faq)--}}
                        {{--<option value="{{$faq['category']}}">--}}
                            {{--{{$faq['category']}}--}}
                        {{--</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}

            <div class="col-sm-9 frmSearch">
                <input type="text" id="faqCategoryToFind" name="categoryFaq" placeholder="Категория" class="form-control" autofocus>
                <div id="faq-category-suggesstion-box"></div>
            </div>
            <input id="findFaqCategoryURL" type="hidden" disabled="disabled" value="{{action('FaqController@findFaqCategory')}}"/>
        </div> <!-- /.form-group -->

        <div class="form-group">
            <label for="questionFaq" class="col-sm-2 control-label">Вопрос</label>
            <div class="col-sm-9">
                <input type="text" id="questionFaq" name="questionFaq" placeholder="" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="answerFaq" class="col-sm-2 control-label">Ответ*</label>
            <div class="col-sm-9">
                <input type="text" id="answerFaq" name="answerFaq" placeholder="" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3 pull-right">
                <button type="submit" class="btn btn-primary btn-block">Добавить</button>
            </div>
        </div>
    </form>
@endsection