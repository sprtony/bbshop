<?php

namespace App\Filament\Pages;

use App\Settings\SocialNetworksSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Guava\FilamentIconPicker\Forms\IconPicker;

class ManageSocialNetworks extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-share';

    protected static ?string $navigationLabel = 'Redes Sociales';

    protected static ?string $navigationGroup = 'Configuraciones';

    protected static ?string $title = 'Redes Sociales';

    protected static string $settings = SocialNetworksSettings::class;

    public static function shouldRegisterNavigation(): bool
    {
        return auth('admin')->user()->can('page_ManageSocialNetworks');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('whatsapp'),

                Forms\Components\Repeater::make('phones')->schema([
                    Forms\Components\TextInput::make('text')->label('Texto'),
                    Forms\Components\TextInput::make('number')->label('Numero'),
                ])->addActionLabel('Agregar telefono')->label('')->columns(2)->grid(2)->columnSpanFull(),

                Forms\Components\Repeater::make('social_networks')->schema([
                    IconPicker::make('icon')->label('Icono'),
                    Forms\Components\TextInput::make('url')->label('URL'),
                ])->addActionLabel('Agregar red social')->label('')->columns(2)->grid(2)->columnSpanFull(),
            ]);
    }
}
