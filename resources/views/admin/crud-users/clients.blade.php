@extends('components.index')

@section('content')
    @include("admin.crud-users.templates.search.clients")
    <br>
    <hr>

    @include("admin.crud-users.templates.table")
@endsection