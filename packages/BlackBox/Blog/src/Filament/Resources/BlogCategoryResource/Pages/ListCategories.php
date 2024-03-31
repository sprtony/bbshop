<?php

namespace Quimaira\Blog\Filament\Resources\BlogCategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Quimaira\Blog\Filament\Resources\BlogCategoryResource;

class ListCategories extends ListRecords
{
    protected static string $resource = BlogCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
