<?php

namespace Quimaira\Catalog\Filament\Resources\ProductResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RelatedProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'related_products';

    protected static ?string $modelLabel = 'producto';
    protected static ?string $pluralModelLabel = 'productos';

    protected static ?string $title = 'Productos relacionados';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->headerActions([
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\DissociateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([]);
    }
}
