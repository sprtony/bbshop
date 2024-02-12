<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\SettingsPage;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

use App\Settings\GeneralSettings;

class ManageGeneral extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'General';
    protected static ?string $navigationGroup = 'Configuraciones';

    protected static ?string $title = 'Configuraciones Generales';

    protected static string $settings = GeneralSettings::class;

    public static function shouldRegisterNavigation(): bool
    {
        return auth('admin')->user()->can('manage General');
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('banner_url')->label('Url del banner principal')->url(),
                Forms\Components\TextInput::make('captcha_public')->label('Clave publica de captcha'),
                Forms\Components\TextInput::make('captcha_private')->label('Clave privada de captcha'),
                TinyEditor::make('privacy')->label('Aviso de privacidad')->columnSpanFull(),
                TinyEditor::make('terms')->label('Terminos y condiciones')->columnSpanFull(),
            ]);
    }
}
