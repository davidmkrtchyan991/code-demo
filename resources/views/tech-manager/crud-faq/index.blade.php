@extends('components.index')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    <div class="col-xs-12 col-md-12">
        <table>
            <tr>
                <td>Категория</td>
                <td>Вопрос</td>
                <td>Ответ</td>
            </tr>
            @foreach($faqs as $faq)
                <tr>
                    <td>{{$faq['category']}}</td>
                    <td>{{$faq['question']}}</td>
                    <td>{{$faq['answer']}}</td>
                    <td><a href="{{action('FaqController@show', $faq['id'])}}" class="btn btn-success">Показать</a></td>
                    <td><a href="{{action('FaqController@edit', $faq['id'])}}" class="btn btn-warning">Редактировать</a></td>
                    <td>
                        <form action="{{action('FaqController@destroy', $faq['id'])}}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection