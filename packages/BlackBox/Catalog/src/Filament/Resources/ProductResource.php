<?php

namespace Quimaira\Catalog\Filament\Resources;

use Illuminate\Support\Str;

use Filament\Forms;
use Filament\Forms\{Form, Set};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use CodeWithDennis\FilamentSelectTree\SelectTree;

use Quimaira\Catalog\Filament\Resources\ProductResource\Pages;
use Quimaira\Catalog\Models\Product;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $modelLabel = 'producto';
    protected static ?string $pluralModelLabel = 'productos';

    protected static ?string $navigationIcon = 'heroicon-m-cube';
    protected static ?string $navigationGroup = 'Catalogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('producto')->tabs([
                    Forms\Components\Tabs\Tab::make('General')->schema([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\TextInput::make('sku')->label('SKU')->required(),
                            Forms\Components\TextInput::make('name')->label('Nombre')
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->required(),
                            Forms\Components\TextInput::make('slug')->label('URL')
                                ->live(onBlur: true)
                                ->unique(ignorable: fn ($record) => $record)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', slugify($state)))
                                ->required(),
                            //BRANDS
                            Forms\Components\Select::make('brand')->label('Marca')->relationship('brand', 'name')->preload()
                                ->createOptionForm([
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

                                ]),
                            // Forms\Components\TextInput::make('price')->label('Precio')->numeric()->prefix('$'),
                            Forms\Components\TextInput::make('capacity')->label('Capacidad'),
                            Forms\Components\FileUpload::make('datasheet')->label('Ficha tecnica')->directory('products'),
                        ])->columns(2),

                        //Toggles
                        Forms\Components\Section::make()->schema([
                            // Forms\Components\Toggle::make('new')->label('Nuevo')->required(),
                            Forms\Components\Toggle::make('featured')->label('Destacado')->required(),
                            Forms\Components\Toggle::make('active')->label('Activo')->required(),
                            Forms\Components\Toggle::make('promotion')->label('Promoción')->required(),
                        ])->columns(3),

                        //Relaciones
                        Forms\Components\Section::make()->schema([
                            // Forms\Components\Select::make('categories')->multiple()->relationship('categories', 'name')->preload()->label('Categorias'),
                            SelectTree::make('categories')->label('Categorias')->relationship('categories', 'name', 'parent_id')
                                ->parentNullValue(-1)->enableBranchNode()->searchable(),
                            Forms\Components\Select::make('related_products')
                                ->multiple()
                                ->relationship(
                                    'related_products',
                                    'name',
                                )
                                ->preload()
                                ->label('Productos relacionados'),
                        ])->columnSpanFull(),
                        TinyEditor::make('description')->label('Descipción')->columnSpanFull(),
                    ])->icon('heroicon-m-cube'),
                    Forms\Components\Tabs\Tab::make('SEO')->schema([
                        Forms\Components\TextInput::make('meta_title')->columnSpan(1),
                        Forms\Components\TextInput::make('meta_keywords')->columnSpan(1),
                        Forms\Components\Textarea::make('meta_description')->columnSpanFull(),
                    ])->columns(2)->icon('vaadin-globe-wire'),
                    Forms\Components\Tabs\Tab::make('Multimedia')->schema([
                        Forms\Components\FileUpload::make('thumbnail')->label('Imagen Principal 1000*1000')->image()->directory('products')->optimize('webp'),
                        Forms\Components\FileUpload::make('gallery')->label('Galeria (Imagen 1000*1000)')->image()->multiple()->reorderable()->directory('products')->optimize('webp'),
                        Forms\Components\TextInput::make('video')->label('Link de Youtube')->url(),
                    ])->icon('heroicon-m-camera')
                ])->columnSpanFull()->persistTabInQueryString(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')->label('SKU')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Url')
                    ->formatStateUsing(fn (string $state): string => route('productOrCategory.index', ['fallbackPlaceholder' => $state]))
                    ->url(fn (Product $product): string => route('productOrCategory.index', ['fallbackPlaceholder' => $product->slug]))
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
