<?php

namespace App\Repositories\Front;

use App\Mail\CommentReceivedMail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PostRepository
{
    public function index($post, $slug) : View | RedirectResponse
    {
        if ($slug !== $post->slug)
        {
            return redirect()->route('front.post.index', [
                'post' => $post->id,
                'slug' => $post->slug,
            ]);
        }

        if (!$post->published && !auth()->check()) {
            abort(404);
        }

        $session_key = 'post_'.$post->id;

        if(!Session::has($session_key)) {
            $post->increment('views');
            Session::put($session_key, \Illuminate\Support\now()->addHours(24));
        }

        $prevPost = Post::where('id', '<', $post->id)
            ->orderBy('id', 'desc')
            ->first();


        $nextPost = Post::where('id', '>', $post->id)
            ->orderBy('id', 'asc')
            ->first();

        $comments = $post->comments()->where('status', 1)->orderBy('created_at', 'desc')->get();

        return view('front.post.index', compact('post', 'prevPost', 'nextPost', 'comments'));
    }

    public function storeComment($request) : JsonResponse
    {
        $url = $request->url;

        $comment = Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'text' => $request->text,
            'post_id' => $request->id,
        ]);

        Mail::to($comment->email)->send(new CommentReceivedMail($comment, $url));

        return response()->json([
            'success' => true,
            'message' => 'Thanks for your comment!',
        ]);
    }
}
