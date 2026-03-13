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
            return Post::published()
                ->important() // Dodao sam ovo jer su ovo "važni" postovi
                ->orderByLatestDate()
                ->limit(3)
                ->get();
        });

        $latestPosts = Cache::remember('posts.latest', 86000, function () {
            return Post::published()
                ->orderByLatestDate()
                ->limit(12)
                ->get();
        });

        $sliders = Cache::remember('sliders', 86000, function () {
            return Slider::orderBy('priority', 'asc')->get();
        });


        return view('front.index._index', compact('importantPosts', 'latestPosts', 'sliders'));
    }
}
