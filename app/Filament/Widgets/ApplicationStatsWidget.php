<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ApplicationStatsWidget extends BaseWidget
{
    public function getStats(): array
    {
        $total = Application::count();
        $hired = Application::where('status', 'hired')->count();
        
        return [
            Stat::make('Total Applications', $total)
                ->icon('heroicon-o-document-text')
                ->description('All time applications')
                ->chart($this->getWeeklyApplicationData())
                ->color('primary'),
                
            Stat::make('New Applications', Application::where('status', 'new')->count())
                ->icon('heroicon-o-sparkles')
                ->description('Requiring review')
                ->color('warning'),
                
            Stat::make('Hired Candidates', $hired)
                ->icon('heroicon-o-check-badge')
                ->description('Successful hires')
                ->color('success'),
                
            Stat::make('Conversion Rate', $total > 0 ? round(($hired / $total) * 100, 1) . '%' : '0%')
                ->icon('heroicon-o-arrow-trending-up')
                ->description('Applications to hires')
                ->color('info'),
        ];
    }

    protected function getWeeklyApplicationData(): array
    {
        return Application::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();
    }
}