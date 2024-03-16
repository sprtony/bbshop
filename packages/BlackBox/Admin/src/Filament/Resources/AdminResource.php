<?php

namespace BlackBox\Admin\Filament\Resources;

use Illuminate\Database\Eloquent\Builder;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use BlackBox\Admin\Filament\Resources\AdminResource\Pages;
use BlackBox\Admin\Models\Admin;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $modelLabel = 'administrador';
    protected static ?string $pluralModelLabel = 'administradores';

    protected static ?string $navigationIcon = 'heroicon-s-user';
    protected static ?string $navigationGroup = 'Control de accesos';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('roles')->multiple()
                    ->relationship('roles', 'name', fn (Builder $query) => $query->where('id', '!=', 1))
                    ->preload()->hidden(fn (Admin $admin) => $admin->id == 1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->hidden(fn (Admin $admin) => $admin->id == 1),
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
            'index' => Pages\ManageAdmins::route('/'),
        ];
    }
}
