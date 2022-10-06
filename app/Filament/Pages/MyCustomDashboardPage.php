<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CustomerOverview;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersFourteenDayWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersOneDayWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersSevenDayWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersTwentyEightDayWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\MostVisitedPagesWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\PageViewsWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsByCountryWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsByDeviceWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsDurationWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsWidget;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\TopReferrersListWidget;
use Filament\Pages\Page;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets\VisitorsWidget;

class MyCustomDashboardPage extends Page
{
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.my-custom-dashboard-page';

    protected function getHeaderWidgets(): array
    {
        return [
            // CustomerOverview::class, 
            VisitorsWidget::class,
            PageViewsWidget::class,
            VisitorsWidget::class,
            ActiveUsersOneDayWidget::class,
            ActiveUsersSevenDayWidget::class,
            ActiveUsersFourteenDayWidget::class,
            ActiveUsersTwentyEightDayWidget::class,
            SessionsWidget::class,
            SessionsDurationWidget::class,
            SessionsByCountryWidget::class,
            SessionsByDeviceWidget::class,
            MostVisitedPagesWidget::class,
            TopReferrersListWidget::class,
        ];
    }
}
