<?php

namespace BlackBox\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsTo, BelongsToMany};

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'slug',
        'new',
        'featured',
        'active',
        'thumbnail',
        'gallery',
        'price',
        'order',
        'video',
        'meta_title',
        'meta_description',
        'meta_keywords',

        'promotion',
        'datasheet',
        'capacity'
    ];

    protected $casts = [
        'gallery' => 'array',
    ];

    public function getYtAttribute()
    {
        $value = $this->video;
        if ($value) {
            $pattern = '#^(?:https?://|//)?(?:www\.|m\.)?(?:youtu\.be/|youtube\.com/(?:embed/|v/|watch\?v=|watch\?.+&v=))([\w-]{11})(?![\w-])#';
            preg_match($pattern, $value, $matches);
            return (isset($matches[1])) ? $matches[1] : '';
        }
        return null;
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function related_products(): BelongsToMany
    {
        return $this->belongsToMany(static::class, 'product_relations', 'parent_id', 'child_id')
            ->limit(4);
    }
}
