<?php

namespace App\Observers;

use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    protected function clearCommentCache(Comment $comment): void
    {
        if ($comment->post_id) {
            Cache::forget("comments.post.{$comment->post->id}");
        }
    }
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        $this->clearCommentCache($comment);
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        $this->clearCommentCache($comment);
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        $this->clearCommentCache($comment);
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        $this->clearCommentCache($comment);
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        $this->clearCommentCache($comment);dd($comment);
    }
}
