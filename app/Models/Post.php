<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['heading', 'slug', 'preheading', 'text', 'image', 'category_id', 'important', 'user_id', 'published', 'views'];

    protected function scopePublished($query) : EloquentBuilder
    {
        return $query->where('published', 1);
    }

    protected function scopeOrderByLatestDate($query) : EloquentBuilder
    {
        return $query->orderBy('created_at', 'desc');
    }

    protected function scopeImportant($query) : EloquentBuilder
    {
        return $query->where('important', 1);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
