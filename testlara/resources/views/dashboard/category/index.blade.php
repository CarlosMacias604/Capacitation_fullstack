@extends('dashboard.master')

@section('content')
    <h1>List of Categories</h1>
    <a href="{{route('category.create')}}" target="blanck">Create Post</a>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $c)
            <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->title}}</td>
                <td>
                    <a href="{{route('category.edit',$c)}}">Edit</a>
                    <a href="{{route('category.show',$c)}}">Show</a>
                    <form action="{{route('category.destroy',$c)}}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>

    {{ $categories->links() }}

@endsection