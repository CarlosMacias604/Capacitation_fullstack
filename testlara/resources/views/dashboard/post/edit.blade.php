@extends('dashboard.master')

@section('content')
    <h1>Actualzar Post: {{$post->title}} </h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data" style="
        display: flex;
        flex-direction: column;
        gap: 10px;">
        @method('PATCH')
        @include('dashboard.post._form', ['task'=>'edit'])
    </form>
@endsection