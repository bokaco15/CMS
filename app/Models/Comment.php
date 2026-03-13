<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['name', 'email', 'text', 'post_id'];

    protected function scopePublished($query) : Builder
    {
        return $query->where('status', 1);
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
