@extends('components.index')

@section('content')
    @include("admin.crud-users.templates.search.users")
    <br>
    <hr>

    @include('components.success-message')
    @include("admin.crud-users.templates.table")
@endsection