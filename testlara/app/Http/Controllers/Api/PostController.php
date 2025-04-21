<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::with('category')->paginate(10));
    }

    public function slug($slug)
    {
        $post = Post::where("slug", $slug)->first();
        if (!$post) {
            return response()->json("Post not found", 404);
        }
        return response()->json($post);
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Post::create($request->validated()));
    }

    public function show(Post $post)
    {
        if (!$post) {
            return response()->json("Post not found", 404);
        }
        return response()->json($post);
    }

    public function update(UpdateRequest $request, Post $post)
    {
        if (!$post) {
            return response()->json("Post not found", 404);
        }
        $post->update($request->validated());
        return response()->json($post);
    }

    public function upload(Request $request, Post $post)
    {
        $data['image'] = $filename = time() . '.' . $request['image']->extension();

        $request->image->move(public_path('uploads/posts'), $filename);

        $post->update($data);
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        if (!$post) {
            return response()->json("Post not found", 404);
        }
        $post->delete();
        return response()->json("Post deleted successfully");
    }
}
