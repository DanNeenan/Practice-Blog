<?php

namespace Tests;

use App\User;
use Exception;
use App\Exceptions\Handler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(Exception $e) {}
            public function render($request, Exception $e) {
                throw $e;
            }
        });
    }

    protected function signIn($user = null)
    {
        $user = $user ?: factory(User::class)->create();
        $this->actingAs($user);
        return $this;
    }

    protected function signOut($user)
    {
        $this->actingAs($user)->call('GET', '/logout');
        return $this;
    }
}
