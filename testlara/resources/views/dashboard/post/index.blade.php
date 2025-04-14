@extends('dashboard.master')

@section('content')
    <h1>List of Posts</h1>
    <a href="{{route('post.create')}}" target="blanck">Create Post</a>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Category</th>
                <th>Posted</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $p)
            <tr>
                <td>{{$p->id}}</td>
                <td>{{$p->title}}</td>
                <td>{{$p->category->title}}</td>
                <td>{{$p->posted}}</td>
                <td>
                    <a href="{{route('post.edit',$p)}}">Edit</a>
                    <a href="{{route('post.show',$p)}}">Show</a>
                    <form action="{{route('post.destroy',$p)}}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>

    {{ $posts->links() }}

@endsection