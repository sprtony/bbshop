<?php

namespace Quimaira\Blog\Filament\Resources\BlogCategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Quimaira\Blog\Filament\Resources\BlogCategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = BlogCategoryResource::class;
}
