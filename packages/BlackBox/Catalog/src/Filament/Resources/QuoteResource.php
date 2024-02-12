<?php

namespace Quimaira\Catalog\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;

use pxlrbt\FilamentExcel\Actions;

use Quimaira\Catalog\Filament\Resources\QuoteResource\Pages;
use Quimaira\Catalog\Models\Quote;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static ?string $modelLabel = 'Cotización';
    protected static ?string $pluralModelLabel = 'Cotizaciones';

    protected static ?string $navigationIcon = 'fas-file-invoice-dollar';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Nombre'),
            Forms\Components\TextInput::make('email'),
            Forms\Components\TextInput::make('phone')->label('Teléfono'),
            Forms\Components\TextInput::make('solution')->label('Solución'),
            Forms\Components\TextInput::make('postal_code')->label('Código Postal'),
            Forms\Components\TextInput::make('city')->label('Ciudad'),
            Forms\Components\TextInput::make('state')->label('Estado'),
            Forms\Components\Textarea::make('message')->label('Comentarios'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('solution')->label('Solución')
                    ->searchable(),
                Tables\Columns\TextColumn::make('postal_code')->label('Código postal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')->label('Ciudad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')->label('Estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')->label('Comentarios'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->color('info')->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ], position: Tables\Enums\ActionsPosition::BeforeColumns)
            ->headerActions([
                Actions\Tables\ExportAction::make()->label('Descargar excel')
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageQuotes::route('/'),
        ];
    }
}
