<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Tag;
use App\Observers\CategoryObserver;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Observers\SliderObserver;
use App\Observers\TagObserver;
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
        Category::observe(CategoryObserver::class);
        Tag::observe(TagObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
