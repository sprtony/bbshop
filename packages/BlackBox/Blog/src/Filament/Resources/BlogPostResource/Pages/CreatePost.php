<?php

namespace Quimaira\Blog\Filament\Resources\BlogPostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Quimaira\Blog\Filament\Resources\BlogPostResource;

class CreatePost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;
}
