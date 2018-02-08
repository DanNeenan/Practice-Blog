<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function a_post_can_be_deleted()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->call('DELETE', '/posts/' . $post->id);
        $this->assertFalse(Post::where('id', $post->id)->exists());
    }

    /** @test */
    public function a_post_cannot_be_deleted_by_unauthorized_users()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $this->actingAs($user)->call('DELETE', '/posts/' . $post->id);
        $this->assertTrue(Post::where('id', $post->id)->exists());
    }

    public function posts_can_be_filtered_by_month()
    {

        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
            'created_at' => \Carbon\Carbon::now()->subMonth(),
        ]);


        $posts = Post::archives();

        $this->assertEquals([
            [
                "year" => $first->created_at->format('Y'),
                "month" => $first->created_at->format('F'),
                "published" => 1
            ],
            [
                "year" => $second->created_at->format('Y'),
                "month" => $second->created_at->format('F'),
                "published" => 1
            ]
        ], $posts);
    }

}
