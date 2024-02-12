<?php

namespace Quimaira\Blog\Filament\Resources;

use Illuminate\Support\Str;

use Filament\Forms;
use Filament\Forms\{Form, Set};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;

use Quimaira\Blog\Filament\Resources\BlogPostResource\Pages;
use Quimaira\Blog\Models\BlogPost;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $modelLabel = 'post';
    protected static ?string $pluralModelLabel = 'posts';

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('title')->label('Titulo')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->required(),
                    Forms\Components\TextInput::make('slug')->label('Url')
                        ->live(onBlur: true)
                        ->unique(ignorable: fn ($record) => $record)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', slugify($state)))
                        ->required(),
                    Forms\Components\TextInput::make('subtitle')->label('Subtitulo'),
                    Forms\Components\DatePicker::make('date')->label('Fecha'),
                    Forms\Components\Repeater::make('tags')->simple(
                        Forms\Components\TextInput::make('tag'),
                    )->grid(2),
                    Forms\Components\Toggle::make('active')->label('Activo')->required(),
                ])->columns(2),

                Forms\Components\Section::make()->schema([
                    Forms\Components\FileUpload::make('image')->label('Imagen 920*517 ')->directory('blog-post')->image()->optimize('webp'),
                    Forms\Components\Textarea::make('description')->label('Descripción'),
                    TinyEditor::make('content')->label('Contenido')->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Titulo')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Url')
                    ->formatStateUsing(fn (string $state): string => route('postOrCategory.index', ['slug' => $state]))
                    ->url(fn (BlogPost $post): string => route('postOrCategory.index', ['slug' => $post->slug]))
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
