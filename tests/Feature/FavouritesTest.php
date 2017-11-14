<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavouritesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function an_authenticated_user_can_favourite_any_reply()
    {
        $post = factory(Post::class)->create();
        $post->comments()->create(factory(Comment::class)->make()->toArray());
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->actingAs($user)->get('/posts/' . $post->id . '/comments/' . $post->comments()->first()->id . '/favourites');
        $this->assertCount(1, $post->comments()->first()->favourites);

        $this->actingAs($user)->get('/posts/' . $post->id . '/comments/' . $post->comments()->first()->id . '/favourites');
        $this->assertCount(0, $post->comments()->first()->favourites);
    }

    public function an_authenticated_user_can_unfavourite_any_reply()
    {
        $this->actingAs($user);

        $this->actingAs($user)->get('/posts/' . $post->id . '/comments/' . $post->comments()->first()->id . '/favourites');
        $this->assertCount(0, $post->comments()->first()->favourites);
    }

}
