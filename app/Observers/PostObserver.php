<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    protected function clearPostCache()
    {
        Cache::forget('posts.important');
        Cache::forget('posts.latest');
    }
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->clearPostCache();
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $this->clearPostCache();
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->clearPostCache();
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->clearPostCache();
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $this->clearPostCache();
    }
}
