<?php

namespace Quimaira\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'image',
        'date',
        'description',
        'content',
        'tags',
        'active'
    ];

    protected $casts = [
        'tags' => 'array',
        'date' => 'date'
    ];
}
