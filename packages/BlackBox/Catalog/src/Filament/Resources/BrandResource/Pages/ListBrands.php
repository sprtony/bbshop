<?php

namespace Quimaira\Catalog\Filament\Resources\BrandResource\Pages;

use Quimaira\Catalog\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBrands extends ListRecords
{
    protected static string $resource = BrandResource::class;
    protected static ?string $title = 'Marcas';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
