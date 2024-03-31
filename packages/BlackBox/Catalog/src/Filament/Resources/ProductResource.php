<?php

namespace BlackBox\Catalog\Filament\Resources;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use BlackBox\Catalog\Enums\AttributeTypes;
use BlackBox\Catalog\Filament\Resources\ProductResource\Pages;
use BlackBox\Catalog\Models\Attribute;
use BlackBox\Catalog\Models\AttributeOption;
use BlackBox\Catalog\Models\Product;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

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

                Forms\Components\Grid::make()->schema([
                    Forms\Components\Tabs::make('producto')->tabs([
                        Forms\Components\Tabs\Tab::make('General')->schema([
                            Forms\Components\Grid::make()->schema([
                                //Base Fields
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
                                    Forms\Components\Select::make('brand')->label('Marca')->relationship('brand', 'name')
                                        ->preload()->createOptionForm(BrandResource::getFields()),
                                ])->columns(2)->columnSpan(2),

                                //Toggles
                                Forms\Components\Section::make()->schema(self::getToggleFields())->columnSpan(1),

                                //Attributes
                                Forms\Components\Section::make()->schema(self::getAttributesFields())->columnSpanFull(),

                                //Prices
                                Forms\Components\Section::make()->schema(self::getPriceFields())
                                    ->columns(2)->hidden(fn (Get $get): bool => ! $get('can_be_sale')),

                                Forms\Components\Section::make()->schema([
                                    Forms\Components\TextInput::make('inventory')->label('Inventario')->numeric()->default(0),
                                ])->hidden(fn (Get $get): bool => ! $get('can_manage_inventory')),

                                TinyEditor::make('description')->label('Descipción')->columnSpanFull(),

                            ])->columns(3),
                        ])->icon('heroicon-m-cube'),
                        self::getSEOTab(),
                        self::getMultimediaTab(),
                        self::getRelationsTab(),

                    ])->columnSpan(3)->persistTabInQueryString(),

                    Forms\Components\Section::make()->schema([
                        Forms\Components\ViewField::make('card_preview')->view('catalog::filament.card-preview'),
                        Forms\Components\ViewField::make('seo_preview')->view('catalog::filament.seo-preview'),
                    ])->columnSpan(1),

                ])->columns(4),

            ]);
    }

    private static function getSEOTab(): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make('SEO')->schema([
            Forms\Components\TextInput::make('meta_title')->columnSpan(1)->live(),
            Forms\Components\TagsInput::make('meta_keywords')->label('Keyword'),
            Forms\Components\Textarea::make('meta_description')->columnSpanFull()->live(),
        ])->columns(2)->icon('vaadin-globe-wire');
    }

    private static function getMultimediaTab(): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make('Multimedia')->schema([
            Forms\Components\FileUpload::make('thumbnail')->label('Imagen Principal 1000*1000')->image()->directory('products')->optimize('webp'),
            Forms\Components\FileUpload::make('gallery')->label('Galeria (Imagen 1000*1000)')->image()->multiple()->reorderable()->directory('products')->optimize('webp'),
            // Forms\Components\TextInput::make('video')->label('Link de Youtube')->url(),
        ])->icon('heroicon-m-camera');
    }

    private static function getRelationsTab(): Forms\Components\Tabs\Tab
    {
        return Forms\Components\Tabs\Tab::make('Relaciones')->schema([

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
        ])->icon('vaadin-tree-table');
    }

    private static function getAttributesFields(): array
    {
        return [
            Forms\Components\Repeater::make('attributesProduct')
                ->label('Atributos')
                ->defaultItems(0)
                ->relationship()
                ->schema([
                    Forms\Components\Grid::make()->schema([
                        // attribute
                        Forms\Components\Select::make('attribute_id')->label('Atributo')
                            ->relationship('attribute', 'name')->preload()->live()
                            ->createOptionForm(self::getAttributeForm())
                            ->editOptionForm(self::getAttributeForm()),

                        // value
                        Forms\Components\Grid::make()->schema(fn (Get $get): array => match ($attribute = Attribute::find($id = $get('attribute_id'))?->type) {
                            AttributeTypes::Text->name => [Forms\Components\TextInput::make('value')->label('Valor')],
                            AttributeTypes::LongText->name => [TinyEditor::make('value')->label('Valor')],
                            AttributeTypes::File->name => [Forms\Components\FileUpload::make('value')->label('Valor')->directory('products')],
                            AttributeTypes::Imagen->name => [Forms\Components\FileUpload::make('value')->label('Valor')->image()->optimize('webp')->directory('products')],
                            AttributeTypes::Boolean->name => [Forms\Components\Toggle::make('value')->label('Valor')],
                            AttributeTypes::Option->name => [
                                Forms\Components\Select::make('value')->label('Valor')->preload()
                                    ->relationship(name: 'attribute.options', titleAttribute: 'name',
                                        modifyQueryUsing: fn (Builder $query) => $query->where('attribute_id', $id))
                                    ->createOptionForm(self::getAttributeOptionsForm())
                                    ->createOptionUsing(function (Get $get, array $data): int {
                                        $data['attribute_id'] = $get('attribute_id');

                                        return AttributeOption::create($data)->getKey();
                                    }),
                                // ->editOptionForm(self::getAttributeOptionsForm()),
                            ],
                            AttributeTypes::Color->name => [
                                Forms\Components\Select::make('value')->label('Valor')->preload()
                                    ->relationship(name: 'attribute.options', titleAttribute: 'name',
                                        modifyQueryUsing: fn (Builder $query) => $query->where('attribute_id', $id))
                                    ->createOptionForm(self::getAttributeColorsForm())
                                    ->createOptionUsing(function (Get $get, array $data): int {
                                        $data['attribute_id'] = $get('attribute_id');

                                        return AttributeOption::create($data)->getKey();
                                    }),
                                // ->editOptionForm(self::getAttributeColorsForm()),
                            ],
                            default => []
                        })->columnSpan(1)->columns(1),
                    ])->columns(2),
                ]),
        ];
    }

    private static function getPriceFields(): array
    {
        return [
            Forms\Components\TextInput::make('price')->label('Precio')->numeric()->prefix('$'),
            Forms\Components\TextInput::make('special_price')->label('Precio especial')->numeric()->prefix('$'),
            Forms\Components\DatePicker::make('special_price_from')->label('Precio especial inicio'),
            Forms\Components\DatePicker::make('special_price_from')->label('Precio especial fin'),
        ];

    }

    private static function getToggleFields(): array
    {
        return [
            Forms\Components\Toggle::make('can_be_sale')->label('Puede ser vendido')->required()->default(true)->live(),
            Forms\Components\Toggle::make('can_manage_inventory')->label('Maneja Inventario')->required()->default(true)->live(),
            Forms\Components\Toggle::make('can_be_shipped')->label('Puede ser enviado')->required(),
            Forms\Components\Toggle::make('new')->label('Nuevo')->required(),
            Forms\Components\Toggle::make('featured')->label('Destacado')->required(),
            Forms\Components\Toggle::make('active')->label('Activo')->required(),
            Forms\Components\Toggle::make('private')->label('Privado')->required(),
        ];
    }

    private static function getAttributeForm(): array
    {
        return [
            Forms\Components\Grid::make()->schema([
                Forms\Components\TextInput::make('name')->label('Nombre')->required(),
                Forms\Components\Select::make('type')->label('Tipo')->required()->options(AttributeTypes::class),
            ])->columns(2),
        ];
    }

    private static function getAttributeOptionsForm(): array
    {
        return [
            Forms\Components\Grid::make()->schema([
                Forms\Components\TextInput::make('name')->label('Nombre')->required(),
                Forms\Components\TextInput::make('value')->label('Valor')->required(),
            ])->columns(2),
        ];

    }

    private static function getAttributeColorsForm(): array
    {
        return [
            Forms\Components\Grid::make()->schema([
                Forms\Components\TextInput::make('name')->label('Nombre')->required(),
                Forms\Components\ColorPicker::make('value')->label('Valor')->required(),
            ])->columns(2),
        ];

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
