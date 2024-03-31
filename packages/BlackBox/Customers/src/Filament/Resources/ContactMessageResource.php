<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use pxlrbt\FilamentExcel\Actions;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $modelLabel = 'Mensaje de contacto';

    protected static ?string $pluralModelLabel = 'Mensajes de contacto';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Nombre'),
            Forms\Components\TextInput::make('email'),
            Forms\Components\TextInput::make('phone')->label('Teléfono'),
            Forms\Components\TextInput::make('whatsapp'),
            Forms\Components\TextInput::make('street')->label('Dirección'),
            Forms\Components\TextInput::make('postal_code')->label('Código Postal'),
            Forms\Components\TextInput::make('city')->label('Ciudad'),
            Forms\Components\TextInput::make('state')->label('Estado'),
            Forms\Components\Textarea::make('message')->label('Mensaje'),
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
                Tables\Columns\TextColumn::make('whatsapp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street')->label('Dirección')
                    ->searchable(),
                Tables\Columns\TextColumn::make('postal_code')->label('Código postal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')->label('Ciudad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')->label('Esado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')->label('Mensaje')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->color('info')->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ], position: Tables\Enums\ActionsPosition::BeforeColumns)
            ->headerActions([
                Actions\Tables\ExportAction::make()->label('Descargar excel'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactMessages::route('/'),
        ];
    }
}
