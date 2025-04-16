@extends('web.layout')

@section('content')
    <x-web.blog.post.show :post="$post">
        <h1>Posts list</h1>
    </x-web.blog.post.show>
@endsection