<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use App\Filament\Widgets\ApplicationFunnelWidget;
use App\Filament\Widgets\ApplicationStatsWidget;
use App\Filament\Widgets\ChatbotFlowUsageWidget;
use App\Filament\Widgets\PopularPositionsWidget;
use App\Filament\Widgets\RecentApplicationsWidget;
use App\Filament\Widgets\RecruiterPerformanceWidget;
use App\Filament\Widgets\TimeToHireWidget;

class Dashboard extends BaseDashboard 
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
            ApplicationStatsWidget::class,
            TimeToHireWidget::class,

            PopularPositionsWidget::class,
            ApplicationFunnelWidget::class,

            ChatbotFlowUsageWidget::class,
            RecruiterPerformanceWidget::class,

            RecentApplicationsWidget::class,
        ];
    }

    protected static string $view = 'filament.pages.dashboard';
}
