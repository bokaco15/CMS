<?php

namespace App\Repositories\Front;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryRepository
{
    public function postsCategory($category, $slug) : View | RedirectResponse
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

        $posts = $category->post()
            ->where('published', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('front.category.index', compact('posts', 'category'));
    }
}
