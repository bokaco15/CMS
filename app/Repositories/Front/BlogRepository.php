<?php

namespace App\Repositories\Front;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class BlogRepository
{
    public function index(Request $request) : View
    {
        $search = $request->query('search');
        $page = $request->query('page', 1);

        $cacheKey = "posts.blog.search.{$search}.page.{$page}";

        $posts = Cache::tags(['posts.blog'])->remember($cacheKey, 86000, function () use ($search) {
            $query = Post::published();

            if ($search) {
                $query->where('heading', 'like', "%{$search}%");
            }

            return $query->orderByLatestDate()
                ->paginate(4);
        });

        $posts->appends(['search' => $search]);

        return view('front.blog._index', compact('posts'));
    }
}
