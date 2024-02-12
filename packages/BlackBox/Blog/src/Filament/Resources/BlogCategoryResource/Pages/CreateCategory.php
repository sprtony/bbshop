<?php

namespace Quimaira\Blog\Filament\Resources\BlogCategoryResource\Pages;

use Quimaira\Blog\Filament\Resources\BlogCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = BlogCategoryResource::class;
}
