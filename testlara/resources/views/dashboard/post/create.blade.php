@extends('dashboard.master')

@section('content')

    @include('dashboard.fragment._errors-form')

    <form action="{{route('post.store')}}" method="post" style="
        display: flex;
        flex-direction: column;
        gap: 10px;">
        @include('dashboard.post._form')
    </form>
@endsection