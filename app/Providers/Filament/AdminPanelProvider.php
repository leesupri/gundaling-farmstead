<?php

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Auth\Pages\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Gundaling Farmstead')
            ->brandLogo(asset('images/logos/Logo_GUNDALING_2-color_tall_on-white.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('favicon-32x32.png'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => new HtmlString('<style>
                    .fi-simple-layout {
                        position: relative;
                        background-image: url(\'' . asset('images/restaurant/welcomeGundaling.jpg') . '\');
                        background-size: cover;
                        background-position: center;
                    }
                    .fi-simple-layout::before {
                        content: \'\';
                        position: absolute;
                        inset: 0;
                        background: linear-gradient(to bottom, rgba(14, 24, 16, .55), rgba(14, 24, 16, .8));
                    }
                    .fi-simple-main {
                        position: relative;
                        z-index: 1;
                        background-color: rgba(255, 255, 255, .16) !important;
                        backdrop-filter: blur(20px);
                        -webkit-backdrop-filter: blur(20px);
                        border: 1px solid rgba(255, 255, 255, .35);
                        box-shadow: 0 8px 32px rgba(0, 0, 0, .3);
                    }
                    .fi-simple-main:where(.dark, .dark *) {
                        background-color: rgba(14, 24, 16, .45) !important;
                        border-color: rgba(255, 255, 255, .15);
                    }
                    .fi-simple-header-heading,
                    .fi-simple-header-heading:where(.dark, .dark *) {
                        color: #fff;
                    }
                </style>'),
                scopes: Login::class,
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->plugin(FilamentShieldPlugin::make())
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
