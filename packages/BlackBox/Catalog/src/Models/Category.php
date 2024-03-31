<?php

namespace BlackBox\Catalog\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

class Category extends Model
{
    use HasFactory, ModelTree;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'mobile',
        'icon',
        'order',
        'visible',
        'parent_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function determineTitleColumnName(): string
    {
        return 'name';
    }

    public function scopeFirstLevel(Builder $query)
    {
        return $query->where($this->determineParentColumnName(), static::defaultParentKey());
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
