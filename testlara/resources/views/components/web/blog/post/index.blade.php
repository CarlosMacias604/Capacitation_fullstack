
{{$slot}}
@foreach ($posts as $p)
    <div class="card card-white mb-2">
        <h3> {{$p->title}} </h3>
        <p> {{$p->description}} </p>
        <a class="btn btn-primary" href="{{route("web.blog.show", $p)}}">Show</a>
    </div>
@endforeach

{{ $posts->links() }}
