<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    protected function clearPostCache(Post $post) : void
    {
        Cache::forget('posts.important');
        Cache::forget('posts.latest');
        Cache::forget('posts.footer');
        Cache::tags(['posts.blog'])->flush();
        if ($post->category->id) {
            Cache::tags(["category.{$post->category->id}"])->flush();
        }
        if ($post->user->id) {
            Cache::tags(["posts.userid.{$post->user->id}"])->flush();
        }
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->clearPostCache($post);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        if($post->wasChanged('views')) {
            return;
        }
        $this->clearPostCache($post);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->clearPostCache($post);
        Cache::forget("comments.post.{$post->id}");
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->clearPostCache($post);
        Cache::forget("comments.post.{$post->id}");
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $this->clearPostCache($post);
        Cache::forget("comments.post.{$post->id}");
    }
}
