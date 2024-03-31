<?php

namespace Quimaira\Blog\Filament\Resources\BlogPostResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Quimaira\Blog\Filament\Resources\BlogPostResource;

class ListPosts extends ListRecords
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
