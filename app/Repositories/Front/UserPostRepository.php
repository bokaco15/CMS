<?php

namespace App\Repositories\Front;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class UserPostRepository
{
    public function postsByUser($user, $slug, $request) : RedirectResponse | View
    {
        if ($slug !== $user->slug)
        {
            return redirect()->route('front.user.post', [
                'user' => $user->id,
                'slug' => $user->slug,
            ]);
        }

        $page = $request->get("page", 1);
        $cacheKey = "posts.userid.{$user->id}.page.{$page}";

        $posts = Cache::tags("posts.userid.{$user->id}")->remember($cacheKey, 86400, function () use ($user) {
            return Post::published()
                ->where('user_id', $user->id)
                ->orderByLatestDate()
                ->paginate(4);
        });
        $posts->withQueryString();

        return view('front.userPost._index', compact('posts', 'user'));
    }
}
