<?php

namespace Quimaira\Blog\Filament\Resources;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Quimaira\Blog\Filament\Resources\BlogCategoryResource\Pages;
use Quimaira\Blog\Models\BlogCategory;

class BlogCategoryResource extends Resource
{
    protected static ?string $model = BlogCategory::class;

    protected static ?string $modelLabel = 'categoria';

    protected static ?string $pluralModelLabel = 'categorias';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Blog';

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
                Forms\Components\TextInput::make('order')->label('Orden')->numeric(),
                Forms\Components\Toggle::make('active')->label('Activo')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Url')
                    ->formatStateUsing(fn (string $state): string => route('postOrCategory.index', ['slug' => $state]))
                    ->url(fn (BlogCategory $category): string => route('postOrCategory.index', ['slug' => $category->slug]))
                    ->openUrlInNewTab(),
                ToggleIconColumn::make('active')->label('Activo')
                    ->onIcon('heroicon-s-eye')
                    ->offIcon('heroicon-m-eye-slash'),

            ])
            ->filters([
                //
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
