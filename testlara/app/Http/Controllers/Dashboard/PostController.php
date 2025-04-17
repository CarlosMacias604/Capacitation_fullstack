<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);

        // $post = Post::find(4);
        // $category = Category::find(1);
        
        // dd($category->posts);

        //$post = Post::find(4)->delete();

        // $post = Post::find(2);

        // $post->update(
        //     [
        //         'title' => 'test title new',
        //         'slug' => 'test slug',
        //         'content' => 'test content',
        //         'image' => 'test image',
        //     ]
        // );

        // Post::create(
        //     [
        //         'title' => 'test3 title',
        //         'slug' => 'test3 slug',
        //         'content' => 'test3 content',
        //         'category_id' => 1,
        //         'description' => 'test3 description',
        //         'posted' => 'not',
        //         'image' => 'test3 image',
        //     ]
        // );
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id', 'title');
        $post = new Post();

        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //LA MEJOR FORMA DE VALIDACION PARA CREAR
        Post::create($request->validated());
        return to_route('post.index');

        //PRIMER FORMA DE VALIDACION        
        // $validated = Validator::make($request ->all(), [
        //     'title' => 'required|min:5|max:500',
        //     'slug' => 'required|min:5|max:500',
        //     'content' => 'required|min:7',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required',
        // ]);
        // dd($validated->fails());

        //SEGUNDA FORMA DE VALIDACION
        // $request->validate([
        //     'title' => 'required|min:5|max:500',
        //     'slug' => 'required|min:5|max:500',
        //     'content' => 'required|min:7',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required',
        // ]);
        
        //TERCERA FORMA DE VALIDACION ( USANDO FORM REQUEST/ CUSTOM REQUEST)
        //php artisan make:request Post/StoreRequest

        //dd($request->all()['title']);
        //dd(request()->get('title'));
        // Post::create(
        //     [
        //         'title' => $request->all()['title'],
        //         'slug' => $request->all()['slug'],
        //         'content' => $request->all()['content'],
        //         'category_id' => $request->all()['category_id'],
        //         'description' => $request->all()['description'],
        //         'posted' => $request->all()['posted']
        //     ]
        // );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    { 
        $data = $request->validated();

        //image

        if(isset($data['image'])){
            $data['image'] = $filename = time().'.'.$data['image']->extension();

            $request->image->move(public_path('uploads/posts'), $filename);
        }
        //image

        $post->update($data);
        return to_route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index');
    }
}
