<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 10)->create()->each(function ($post) {
            $post->tags()->attach(rand(1, Tag::orderBy('id', 'desc')->first()->id));
        });
    }
}
