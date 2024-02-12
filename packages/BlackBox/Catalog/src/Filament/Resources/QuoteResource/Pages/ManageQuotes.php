<?php

namespace Quimaira\Catalog\Filament\Resources\QuoteResource\Pages;

use Quimaira\Catalog\Filament\Resources\QuoteResource;
use Filament\Resources\Pages\ManageRecords;

class ManageQuotes extends ManageRecords
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
