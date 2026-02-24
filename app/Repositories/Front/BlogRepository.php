<?php

namespace App\Repositories\Front;

use App\Models\Post;
use Illuminate\View\View;

class BlogRepository
{
    public function index($request) : View
    {
        if($request->isMethod('get')) {
            $request->validate(['search' => 'nullable|string']);
        }
        $search = $request->search;

        $query = Post::where('published', 1);

        if ($search) {
            $query->where('heading', 'like', "%{$search}%");
        }

        $posts = $query->orderBy('created_at', 'desc')
            ->paginate(4)
            ->appends(['search' => $search]);
        return view('front.blog._index', compact('posts'));
    }
}
