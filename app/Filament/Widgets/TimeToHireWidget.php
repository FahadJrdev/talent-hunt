<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TimeToHireWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $hiredApps = Application::query()
            ->where('status', 'hired')
            ->whereNotNull('last_status_change')
            ->get();

        // Handle empty case
        if ($hiredApps->isEmpty()) {
            return [
                Stat::make('No Hires Recorded', 'N/A')
                    ->icon('heroicon-o-information-circle')
                    ->color('gray')
            ];
        }

        // Calculate metrics
        $hiringTimes = $hiredApps->map(function($app) {
            return $app->created_at->diffInDays($app->last_status_change);
        });

        return [
            Stat::make('Avg Time to Hire', round($hiringTimes->avg()).' days')
                ->icon('heroicon-o-clock')
                ->description('From application to hire')
                ->color('primary'),
                
            Stat::make('Median Time', round($hiringTimes->median()).' days')
                ->icon('heroicon-o-clock')
                ->description('Median hiring time')
                ->color('info'),
                
            Stat::make('Fastest Hire', round($hiringTimes->min()).' days')
                ->icon('heroicon-o-bolt')
                ->description('Fastest hiring time')
                ->color('success'),
                
            Stat::make('Slowest Hire', round($hiringTimes->max()).' days')
                ->icon('heroicon-o-clock')
                ->description('Slowest hiring time')
                ->color('danger'),
        ];
    }
}