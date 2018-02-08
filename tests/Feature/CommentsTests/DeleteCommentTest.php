<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteCommentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function a_comment_can_be_deleted()
    {
        $user = factory(User::class)->create();
        $comment = factory(comment::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->call('DELETE', '/posts/' . $comment->post_id . '/comments/' . $comment->id . '/delete');
        $this->assertFalse(Comment::where('id', $comment->id)->exists());
    }

    /** @test */
    public function a_posts_creator_can_delete_comments()
    {
        $post = factory(Post::class)->create();
        $comment = factory(comment::class)->create([
            'post_id' => $post->id,
        ]);

        $this->actingAs($post->user_id)->call('DELETE', '/posts/' . $post->id . '/comments/' . $comment->id . '/delete');
        $this->assertFalse(Comment::where('id', $comment->id)->exists());
    }

    /** @test */
    public function unauthorised_users_cannot_delete_comments()
    {
        $user = factory(User::class)->create();
        $comment = factory(comment::class)->create();

        $this->actingAs($user)->call('DELETE', '/posts/' . $comment->post_id . '/comments/' . $comment->id . '/delete');
        $this->assertTrue(Comment::where('id', $comment->id)->exists());
    }
}
