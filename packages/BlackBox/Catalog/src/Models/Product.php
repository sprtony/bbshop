<?php

namespace BlackBox\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'slug',
        'description',
        'can_be_sale',
        'can_manage_inventory',
        'can_be_shipped',
        'new',
        'featured',
        'active',
        'private',
        'thumbnail',
        'gallery',
        'price',
        'special_price',
        'special_price_from',
        'special_price_to',
        'inventory',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'parent_id',
        'brand_id',
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

    public function attributesProduct(): HasMany
    {
        return $this->hasMany(AttributeProduct::class);
    }
}
