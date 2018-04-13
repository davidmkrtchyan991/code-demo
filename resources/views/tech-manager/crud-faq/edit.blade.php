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
    <form method="post" action="{{action('FaqController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
            <label for="categoryFaq" class="col-sm-2 control-label">Категория</label>
            <div class="col-sm-9">

                <select name="categoryFaq" id="categoryFaq" class="form-control">
                    @foreach($faqCategories as $faqCategory)

                        <option value="{{$faqCategory['category']}}" @if($faqCategory['category'] === $faq['category']) selected="selected" @endif>
                            {{$faqCategory['category']}}
                        </option>

                    @endforeach
                </select>
            </div>
        </div> <!-- /.form-group -->

        <div class="form-group">
            <label for="questionFaq" class="col-sm-2 control-label">Вопрос</label>
            <div class="col-sm-9">
                <input type="text" id="questionFaq" value="{{$faq['question']}}" name="questionFaq" placeholder="" class="form-control" autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="answerFaq" class="col-sm-2 control-label">Ответ*</label>
            <div class="col-sm-9">
                <input type="text" id="answerFaq" value="{{$faq['answer']}}" name="answerFaq" placeholder="" class="form-control">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3 pull-right">
                <button type="submit" class="btn btn-primary btn-block">Обновить</button>
            </div>
        </div>
    </form>
@endsection