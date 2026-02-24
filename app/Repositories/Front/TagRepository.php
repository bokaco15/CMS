<?php

namespace App\Repositories\Front;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagRepository
{
    public function postsTag($tag, $slug) : View | RedirectResponse
    {
        if ($slug !== $tag->slug)
        {
            return redirect()->route('front.tags.index', [
                'tag' => $tag->id,
                'slug' => $tag->slug,
            ]);
        }

        $posts = $tag->posts()
            ->where('published', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('front.tags.index', compact('posts', 'tag'));
    }
}
