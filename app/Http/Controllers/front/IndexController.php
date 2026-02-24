<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        $importantPosts = Post::where('published', 1)
            ->where('important', 1)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $latestPosts = Post::where('published', 1)
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();

        $sliders = Slider::orderBy('priority', 'asc')->get();


        return view('front.index._index', compact('importantPosts', 'latestPosts', 'sliders'));
    }
}
