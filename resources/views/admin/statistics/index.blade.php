@extends('components.index')

@section('content')
    @include("admin.statistics.templates.filter-form")
    <br>
    <hr>
    @isset($filteredResults)
        @include('components.success-message')
        @if($request->isOrder())
            @include("admin.statistics.templates.results.filter-orders-result")
        @else
            @include("admin.statistics.templates.results.filter-clients-result")
        @endif
    @endisset
@endsection