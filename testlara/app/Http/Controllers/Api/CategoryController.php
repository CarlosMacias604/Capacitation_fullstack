<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::get());
    }

    public function slug($slug){
        $category = Category::where("slug", $slug)->first();
        if (!$category) {
            return response()->json("Post not found", 404);
        }
        return response()->json($category);
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Category::create($request->validated()));
    }

    public function show(Category $category)
    {
        if (!$category) {
            return response()->json("Category not found", 404);
        }
        return response()->json($category);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        if (!$category) {
            return response()->json("Category not found", 404);
        }
        $category->update($request->validated());
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        if (!$category) {
            return response()->json("Category not found", 404);
        }
        $category->delete();
        return response()->json("Category deleted successfully");
    }

    public function posts(Category $category)
    {
        //QUERY BUILDER
        // $posts = Post::join('categories', 'categories.id', '=', 'posts.category_id')
        // ->select("posts.*", "categories.title as category")
        // ->where('posts.category_id', $category->id)
        // ->get();

        //ELOQUENT
        //LA MEJOR MANERA DE HACERLO
        $posts = Post::with("category")
        ->where("category_id", $category->id)
        ->get();    

        return response()->json($posts);
    }
}
