<?php

namespace BlackBox\Catalog\Filament\Resources;

use Illuminate\Support\Str;

use Filament\Forms;
use Filament\Forms\{Form, Set};
use Filament\Resources\Resource;

use BlackBox\Catalog\Filament\Resources\CategoryResource\Pages;
use BlackBox\Catalog\Models\Category;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $modelLabel = 'categoria';
    protected static ?string $pluralModelLabel = 'categorias';

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Catalogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\TextInput::make('name')->label('Nombre')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->required()->columnSpan(1),
                    Forms\Components\TextInput::make('slug')->label('Url')
                        ->live(onBlur: true)
                        ->unique(ignorable: fn ($record) => $record)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', slugify($state)))
                        ->required(),
                    Forms\Components\FileUpload::make('image')->label('Banner 1900*260')->image()->directory('categories')->optimize('webp'),
                    Forms\Components\FileUpload::make('mobile')->label('Banner movil 700*700')->image()->directory('categories')->optimize('webp'),
                    Forms\Components\FileUpload::make('icon')->directory('categories'),
                    Forms\Components\Toggle::make('visible')->label('Visible')->required(),
                ])->columns(2),
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
            'index' => Pages\TreeCategory::route('/'),
        ];
    }
}
