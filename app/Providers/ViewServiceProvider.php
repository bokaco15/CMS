<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        View::composer('front._layout.footer', function($view) {
            $footerCategories = Cache::remember('categories.footer', 86400, function() {
                return Category::published()->orderByPriority()->limit(4)->get();
            });
            $view->with('footerCategory', $footerCategories);
        });
        View::composer(['front._layout.footer', 'front.blog.aside', 'front.contact.aside'], function($view) {
            $footerPosts = Cache::remember('posts.footer', 86400, function() {
                return Post::published()->orderByLatestDate()->limit(3)->get();
            });
            $view->with('latestFooterPosts', $footerPosts);
        });
        View::composer('front.blog.aside', function($view) {
            $categoriesAside = Cache::remember('categories.aside', 86400, function() {
                return Category::published()->orderByPriority()->limit(5)->get();
            });
            $view->with('asideCategories', $categoriesAside);
        });
        View::composer('front.blog.aside', function($view) {
            $asideTags = Cache::remember('tags.aside', 86400, function() {
                return Tag::inRandomOrder()->limit(5)->get();
            });
            $view->with('tags', $asideTags);
        });
    }
}
