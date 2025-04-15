@extends('dashboard.master')

@section('content')

    @include('dashboard.fragment._errors-form')

    <form action="{{route('category.store')}}" method="POST" style="
        display: flex;
        flex-direction: column;
        gap: 10px;">
        @include('dashboard.category._form')
    </form>
@endsection