<?php

namespace Quimaira\Blog\Filament\Resources\BlogPostResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Quimaira\Blog\Filament\Resources\BlogPostResource;

class EditPost extends EditRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
