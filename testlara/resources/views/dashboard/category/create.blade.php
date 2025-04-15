@extends('dashboard.layout')

@section('content')
    <h1>Create Category</h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{route('category.store')}}" method="POST">
        @include('dashboard.category._form')
    </form>
@endsection