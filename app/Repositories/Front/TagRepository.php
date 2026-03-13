<?php

namespace App\Repositories\Front;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class TagRepository
{
    public function postsTag($tag, $slug, Request $request) : View | RedirectResponse
    {
        if ($slug !== $tag->slug)
        {
            return redirect()->route('front.tags.index', [
                'tag' => $tag->id,
                'slug' => $tag->slug,
            ]);
        }

        $page = $request->get("page", 1);
        $cacheKey = "tag.{$tag->id}.page.{$page}";

        $posts = Cache::tags(["tag.{$tag->id}"])->remember($cacheKey, 86400, function () use ($tag) {
            return $tag->posts()
                ->published()
                ->orderByLatestDate()
                ->paginate(4);
        });

        $posts->withQueryString();

        return view('front.tags.index', compact('posts', 'tag'));
    }
}
