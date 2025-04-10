@extends('master')

@section('content')
    <h1>Contact 1</h1>
    <p> {{$posts[0]}} </p>



    {{-- @if ($name != 'Carlos')
        Tu nombre no es Carlos
    @else
        Tu nombre es Carlos
    @endif

    <ul>
        @foreach ([1,2,3,4,5] as $item)
            <li> {{$item}} </li>
        @endforeach
    </ul> --}}
@endsection