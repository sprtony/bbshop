<?php

namespace Quimaira\Catalog\Filament\Resources\BrandResource\Pages;

use Quimaira\Catalog\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;
    protected static ?string $title = "Crear Marca";
}
