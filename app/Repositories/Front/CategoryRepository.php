<?php

namespace App\Repositories\Front;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoryRepository
{
    public function postsCategory($category, $slug, $request) : View | RedirectResponse
    {
        if ($slug !== $category->slug)
        {
            return redirect()->route('front.category.index', [
                'category' => $category->id,
                'slug' => $category->slug,
            ]);
        }

        if (!Auth::user() && $category->show_on_index != 1) {
            abort(403, 'Unauthorized action.');
        }

        $page = $request->query('page', 1);
        $cacheKey = "category.{$category->id}.page.{$page}";

        $posts = Cache::tags(["category.{$category->id}"])
            ->remember($cacheKey, 86400, function () use ($category) {
                return $category->post()
                    ->published()
                    ->orderByLatestDate()
                    ->paginate(4);
            });

        $posts->withQueryString();

        return view('front.category.index', compact('posts', 'category'));
    }
}
