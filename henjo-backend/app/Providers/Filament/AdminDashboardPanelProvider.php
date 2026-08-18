<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminDashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Henjo Safaris')

            // ==========================================
            // HENJO BRAND COLORS
            // Same palette as the public site (app/globals.css on the frontend)
            // ==========================================
            // Primary:   Forest Green   #2E7D32 (main actions, navigation)
            // Secondary: Safari Gold    #D4A017 (accents, highlights — used as Filament's "info")
            // Success:   Green (light)  #4CAF50
            // Warning:   Sunset Amber   #E5A100
            // Danger:    Brand Maroon   #7B1818 (destructive actions)
            // Gray:      Stone, a warm neutral — matches the site's cream/sand surfaces
            //            (#FAFAF5, #F3F1EB, #E5E2D9) instead of Filament's default cool Zinc
            // ==========================================
            ->colors([
                'primary' => Color::hex('#2E7D32'),
                'gray' => Color::Stone,
                'info' => Color::hex('#D4A017'),
                'success' => Color::hex('#4CAF50'),
                'warning' => Color::hex('#E5A100'),
                'danger' => Color::hex('#7B1818'),
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->darkMode()
            ->databaseNotifications()
            ->sidebarCollapsibleOnDesktop()
            ->unsavedChangesAlerts()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
