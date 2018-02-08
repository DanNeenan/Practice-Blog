<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpamDetectionTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function comments_that_contain_spam_may_not_be_created()
    {
        $this->signIn();

        $post = factory('App\Post')->create();
        $comment = factory('App\Comment', [
            'body' => 'aaaaaaaaa'
        ])->make();

        $this->expectException(\Exception::class);

        $this->post($post->path() . '/comment', $comment->toArray());
    }
}
