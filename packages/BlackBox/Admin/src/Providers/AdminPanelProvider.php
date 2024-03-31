<?php

namespace BlackBox\Admin\Providers;

use App\Filament\Pages;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use BlackBox\Admin\Filament\Resources;
use BlackBox\Catalog\Filament\CatalogPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages as BasePages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function register(): void
    {
        parent::register();
        FilamentAsset::register([
            Css::make('local-stylesheet', Vite::asset('resources/css/filament.css')),
        ]);
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path(config('app.admin_url'))
            ->login()
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn (): string => Blade::render('<a href="'.route('home').'" target="_blank"><x-heroicon-s-home class="h-5" /></a>')
            )
            ->databaseNotifications()
            ->navigationGroups([
                'Catalogo',
                // 'Blog',
            ])
            ->resources([
                Resources\AdminResource::class,
            ])
            ->pages([
                BasePages\Dashboard::class,
                Pages\ManageSite::class,
                Pages\ManageEmail::class,
                Pages\ManageSocialNetworks::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('admin')
            ->plugins([
                CatalogPlugin::make(),
                SpatieLaravelTranslatablePlugin::make()->defaultLocales(['es', 'en']),
                FilamentShieldPlugin::make(),
            ]);
    }
}
