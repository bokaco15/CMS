<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug', 'show_on_index', 'priority'
    ];

    protected function scopePublished($query) : Builder
    {
        return $query->where('show_on_index', 1);
    }

    protected function scopeOrderByPriority($query) : Builder
    {
        return $query->orderBy('priority');
    }

    public function post(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
