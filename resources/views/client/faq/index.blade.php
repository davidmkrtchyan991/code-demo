@extends('components.index')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    <div class="col-xs-12 col-md-12">

        @include('client.faq.search')
        <hr>
        <table class="table-margined">
            <thead>
            <tr>
                <td>@lang('custom.category.label')</td>
                <td>@lang('custom.question.label')</td>
                <td>@lang('custom.answer.label')</td>
            </tr>
            </thead>
            <tbody>
            @foreach($faqs as $faq)
                <tr>
                    <td>{{$faq['category']}}</td>
                    <td>{{$faq['question']}}</td>
                    <td>{{$faq['answer']}}</td>
                    <td><a href="{{action('FaqController@show', $faq['id'])}}" class="btn btn-success">Показать</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection