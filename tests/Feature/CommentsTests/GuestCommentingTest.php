<?php

namespace Tests\Feature;

use App\Post;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuestCommentingTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function testExample()
    {
        $body = 'Comment';
        $post = factory(Post::class)->create();
        $post->addComment($body);

        $this->get('/posts/' . $post->id)->assertSee('Guest');
    }
}
