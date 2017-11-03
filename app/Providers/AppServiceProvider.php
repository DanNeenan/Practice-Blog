<?php

namespace App\Providers;

use \App\Billing\Stripe;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view) {
            if (auth()->check()) {
                $subscribed = auth()->user()->subscribed;
            } else {
                $subscribed = collect();
            }

            $archives = \App\Post::archives();

            $tags = \App\Tag::has('posts')
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->limit(10)->get();

            $view->with(compact('archives', 'tags', 'subscribed'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Stripe::class, function () {
            return new Stripe(config('services.stripe.secret'));
        });
    }
}
