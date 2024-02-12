<?php

namespace Quimaira\Catalog\Filament\Resources\BrandResource\Pages;

use Quimaira\Catalog\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;
    protected static ?string $title = "Editar Marca";

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
