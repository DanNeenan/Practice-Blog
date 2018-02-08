<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_login_with_email()
    {
        $user = factory(User::class)->create();
        $this->signOut($user);

        $response = $this->call('POST', 'login', [
            'email' => $user->email,
            'password' => 'secret',
            '_token' => csrf_token()
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function a_user_can_login_with_username()
    {
        $user = factory(User::class)->create();
        $this->signOut($user);

        $response = $this->call('POST', 'login', [
            'username' => $user->username,
            'password' => 'secret',
            '_token' => csrf_token()
        ]);

        $response->assertRedirect('/');
    }
}
