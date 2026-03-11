<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        $importantPosts = Cache::remember('posts.important', 86000, function () {
            Post::where('published', 1)
                ->where('important', 1)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        });

        $latestPosts = Cache::remember('posts.latest', 86000, function () {
            Post::where('published', 1)
                ->orderBy('created_at', 'desc')
                ->limit(12)
                ->get();
        });

        $sliders = Cache::remember('sliders', 86000, function () {
            Slider::orderBy('priority', 'asc')->get();
        });


        return view('front.index._index', compact('importantPosts', 'latestPosts', 'sliders'));
    }
}
