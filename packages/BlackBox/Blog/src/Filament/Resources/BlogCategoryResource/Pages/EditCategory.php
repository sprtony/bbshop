<?php

namespace Quimaira\Blog\Filament\Resources\BlogCategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Quimaira\Blog\Filament\Resources\BlogCategoryResource;

class EditCategory extends EditRecord
{
    protected static string $resource = BlogCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
