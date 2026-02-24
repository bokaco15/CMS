<?php

namespace App\Repositories\Front;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserPostRepository
{
    public function postsByUser($user, $slug) : RedirectResponse | View
    {
        if ($slug !== $user->slug)
        {
            return redirect()->route('front.user.post', [
                'user' => $user->id,
                'slug' => $user->slug,
            ]);
        }

        $posts = Post::where('published', 1)
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('front.userPost._index', compact('posts', 'user'));
    }
}
