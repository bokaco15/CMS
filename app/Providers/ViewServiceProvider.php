<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
            $view->with('footerCategory', Category::where('show_on_index', 1)->orderBy('priority')->limit(4)->get());
        });
        View::composer(['front._layout.footer', 'front.blog.aside', 'front.contact.aside'], function($view) {
            $view->with('latestFooterPosts', Post::where('published', 1)->orderBy('created_at', 'desc')->limit(3)->get());
        });
        View::composer('front.blog.aside', function($view) {
            $view->with('asideCategories', Category::where('show_on_index', 1)->orderBy('priority')->limit(5)->get());
        });
        View::composer('front.blog.aside', function($view) {
            $view->with('tags', Tag::inRandomOrder()->limit(5)->get());
        });
    }
}
