<?php

namespace BlackBox\Catalog\Filament\Resources;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use BlackBox\Catalog\Filament\Resources\BrandResource\Pages;
use BlackBox\Catalog\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $modelLabel = 'marca';

    protected static ?string $pluralModelLabel = 'marcas';

    protected static ?string $navigationIcon = 'heroicon-s-archive-box';

    protected static ?string $navigationGroup = 'Catalogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getFields());
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\TextInput::make('name')->label('Nombre')->required(),
            Forms\Components\FileUpload::make('icon')->label('Logo 250*100')->image()->directory('brands')->optimize('webp'),
            Forms\Components\Toggle::make('active')->label('Activo')->required(),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                ToggleIconColumn::make('active')->label('Activo')
                    ->onIcon('heroicon-s-eye')
                    ->offIcon('heroicon-m-eye-slash'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBrands::route('/'),
        ];
    }
}
