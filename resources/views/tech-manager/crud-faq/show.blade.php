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
    <div class="col-xs-12 col-md-12">
        <table>

            <tr>
                <td>ID</td>
                <td>Категория</td>
                <td>Вопрос</td>
                <td>Ответ</td>
            </tr>
            <tr>
                <td>{{$faq['id']}}</td>
                <td>{{$faq['category']}}</td>
                <td>{{$faq['question']}}</td>
                <td>{{$faq['answer']}}</td>
            </tr>

        </table>
    </div>
@endsection