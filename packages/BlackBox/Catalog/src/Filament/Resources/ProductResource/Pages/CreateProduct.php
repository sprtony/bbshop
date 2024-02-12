<?php

namespace Quimaira\Catalog\Filament\Resources\ProductResource\Pages;

use Quimaira\Catalog\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $title = "Crear Producto";
}
