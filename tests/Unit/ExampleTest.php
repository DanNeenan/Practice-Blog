<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use DatabaseTransaction;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
            'created_at' => \Carbon\Carbon::now()->subMonth(),
            ]);


        $posts = Post::archives();

        $this->assertCount([
            [
                "year" => $first->created_at->format('Y'),
                "month" => $first->created_at->format('M'),
                "published" => 1
            ],
            [
                "year" => $second->created_at->format('Y'),
                "month" => $second->created_at->format('M'),
                "published" => 1
            ]
        ], $posts);

        function a_thread_can_be_deleted()
        {
            $this->user();

            $post = create('App\Posts');

            $this->json('DELETE', $thread->path());

            $this->assertDatabaseMissing('posts', $post->toArray());
        }
    }
}
