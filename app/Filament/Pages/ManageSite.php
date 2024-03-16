<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\SettingsPage;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

use App\Settings\SiteSettings;

class ManageSite extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'General';
    protected static ?string $navigationGroup = 'Configuraciones';

    protected static ?string $title = 'Configuraciones del Sitio';

    protected static string $settings = SiteSettings::class;

    public static function shouldRegisterNavigation(): bool
    {
        return auth('admin')->user()->can('page_ManageSite');
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('captcha_public')->label('Clave publica de captcha'),
                Forms\Components\TextInput::make('captcha_private')->label('Clave privada de captcha'),
                TinyEditor::make('privacy')->label('Aviso de privacidad')->columnSpanFull(),
                TinyEditor::make('terms')->label('Terminos y condiciones')->columnSpanFull(),

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
