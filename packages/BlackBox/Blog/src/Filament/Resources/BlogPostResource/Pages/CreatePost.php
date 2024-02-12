<?php

namespace Quimaira\Blog\Filament\Resources\BlogPostResource\Pages;

use Quimaira\Blog\Filament\Resources\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;
}
