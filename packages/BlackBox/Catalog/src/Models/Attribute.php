<?php

namespace BlackBox\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(AttributeProduct::class)->withPivot('value');
    }

    public function options(): HasMany
    {
        return $this->hasMany(AttributeOption::class);
    }
}
