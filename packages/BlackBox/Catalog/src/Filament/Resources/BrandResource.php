<?php

namespace Quimaira\Catalog\Filament\Resources;

use Illuminate\Support\Str;

use Filament\Forms;
use Filament\Forms\{Form, Set};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;

use Quimaira\Catalog\Filament\Resources\BrandResource\Pages;
use Quimaira\Catalog\Models\Brand;

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
            ->schema([
                Forms\Components\TextInput::make('name')->label('Nombre')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),
                Forms\Components\TextInput::make('slug')->label('Url')
                    ->live(onBlur: true)
                    ->unique(ignorable: fn ($record) => $record)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', slugify($state)))
                    ->required(),
                Forms\Components\FileUpload::make('icon')->label('Logo 250*100')->image()->directory('brands')->optimize('webp'),
                Forms\Components\Toggle::make('active')->label('Activo')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Url')
                    ->formatStateUsing(fn (string $state): string => url('productos/?' . urldecode('marcas[0]=' . $state)))
                    ->url(fn (Brand $brand): string => url('productos/?' . urldecode('marcas[0]=' . $brand->slug)))
                    ->openUrlInNewTab(),

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
