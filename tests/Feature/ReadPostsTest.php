<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadPostsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_filter_posts_according_to_a_tag()
    {
        $tag = factory('App\Tag')->create();
        $postWithTag = factory('App\Post')->create();
        $postWithTag->tags()->attach($tag->id);
        $postWithoutTag = factory('App\Post')->create();

        $this->get('/posts/tags/' . $tag->name)
            ->assertSee($postWithTag->title)
            ->assertDontSee($postWithoutTag->title);
    }
}
