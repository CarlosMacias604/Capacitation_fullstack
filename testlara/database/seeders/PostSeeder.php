<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $categories = Category::all();

        for ($i=0; $i < 30 ; $i++) { 
            $c = Category::inRandomOrder()->first();

            $title = Str::random(20);

            Post::create(
                [
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'content' => "<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis impedit repudiandae esse totam aperiam, quidem sint perferendis ullam aliquam voluptatum nihil saepe quisquam adipisci voluptatibus non? Eaque excepturi praesentium laudantium.</p>",
                    'category_id' => $c->id,
                    'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit.",
                    'posted' => "yes",
                ]
            );
        }
    }
}
