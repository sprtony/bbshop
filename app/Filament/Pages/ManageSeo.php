<?php

namespace App\Filament\Pages;

use App\Settings\SeoSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSeo extends SettingsPage
{
    protected static ?string $navigationIcon = 'vaadin-globe-wire';
    protected static ?string $navigationLabel = 'SEO';
    protected static ?string $navigationGroup = 'Configuraciones';

    protected static ?string $title = 'SEO';

    protected static string $settings = SeoSettings::class;

    public static function shouldRegisterNavigation(): bool
    {
        return auth('admin')->user()->can('manage Seo');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Nombre del sitio'),
                Forms\Components\FileUpload::make('favicon')->label('Favicon 100*100')->image()->optimize('webp')->directory('settings'),
                Forms\Components\FileUpload::make('logo')->label('Logo 331*67')->image()->optimize('webp')->directory('settings'),
                Forms\Components\FileUpload::make('logo_footer')->label('Logo del footer 235*195')->image()->optimize('webp')->directory('settings'),
                Forms\Components\Textarea::make('description')->label('Descripción')->autosize(),
                Forms\Components\TagsInput::make('keywords'),
                Forms\Components\FileUpload::make('og_image')->label('Imagen OG 700*700')->optimize('webp')->directory('settings'),
                Forms\Components\Textarea::make('header')->label('Codigos Extra')->autosize(),
            ]);
    }
}
