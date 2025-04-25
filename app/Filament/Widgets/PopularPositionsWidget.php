<?php

namespace App\Filament\Widgets;

use App\Models\JobPosition;
use Filament\Widgets\BarChartWidget;

class PopularPositionsWidget extends BarChartWidget
{
    public function getHeading(): string
    {
        return 'Most Applied-To Positions (Last 30 Days)';
    }

    protected function getData(): array
    {
        $positions = JobPosition::query()
            ->withCount(['applications' => function($query) {
                $query->where('created_at', '>=', now()->subDays(30));
            }])
            ->orderBy('applications_count', 'desc')
            ->limit(5)
            ->get();

        return [
            'labels' => $positions->pluck('title'),
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $positions->pluck('applications_count'),
                    'backgroundColor' => ['#3b82f6', '#6366f1', '#8b5cf6', '#ec4899', '#f43f5e'],
                ],
            ],
        ];
    }
}
