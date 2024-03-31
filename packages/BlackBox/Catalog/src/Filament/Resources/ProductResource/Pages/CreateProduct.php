<?php

namespace BlackBox\Catalog\Filament\Resources\ProductResource\Pages;

use BlackBox\Catalog\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $title = 'Crear Producto';
}
