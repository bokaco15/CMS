<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Slider;
use App\Observers\PostObserver;
use App\Observers\SliderObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Post::observe(PostObserver::class);
        Slider::observe(SliderObserver::class);
    }
}
