@extends('dashboard.master')

@section('content')
    <h1>Actualzar Post: {{$category->title}} </h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{route('category.update', $category->id)}}" method="POST" style="
        display: flex;
        flex-direction: column;
        gap: 10px;">
        @method('PATCH')
        @include('dashboard.category._form', ['task'=>'edit'])
    </form>
@endsection