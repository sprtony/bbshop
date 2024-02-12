<?php

namespace BlackBox\Admin\Providers;

use App\Filament\Pages;
use App\Filament\Resources;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages as BasePages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path(config('app.admin_url'))
            ->login()
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                'panels::user-menu.before',
                fn (): string => Blade::render('<a href="' . route('home') . '" target="_blank"><x-heroicon-s-home class="h-5" /></a>')
            )
            ->navigationGroups([
                // 'Catalogo',
                // 'Blog',
            ])
            ->resources([
                // Resources\ContactMessageResource::class,
                // Resources\AdminResource::class,
                // Resources\RoleResource::class,
                // Resources\PermissionResource::class,
            ])
            ->pages([
                BasePages\Dashboard::class,
                Pages\ManageGeneral::class,
                Pages\ManageEmail::class,
                Pages\ManageSeo::class,
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
                SpatieLaravelTranslatablePlugin::make()->defaultLocales(['es', 'en']),
            ]);
    }
}
