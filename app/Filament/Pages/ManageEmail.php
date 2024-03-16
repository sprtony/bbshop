<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\SettingsPage;

use App\Settings\EmailSettings;

class ManageEmail extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Email';

    protected static ?string $navigationGroup = 'Configuraciones';

    protected static ?string $title = 'Email';

    protected static string $settings = EmailSettings::class;

    public static function shouldRegisterNavigation(): bool
    {
        return auth('admin')->user()->can('page_ManageEmail');
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')->label('Correo para notificaciónes')->email(),
                Forms\Components\ColorPicker::make('color'),
                Forms\Components\FileUpload::make('logo')->label('Logo 331*67')->image()->optimize('webp'),
                Forms\Components\Repeater::make('bcc')->simple(
                    Forms\Components\TextInput::make('email')->email(),
                )->addActionLabel('Agregar correo')->label('Bcc'),
            ]);
    }
}
