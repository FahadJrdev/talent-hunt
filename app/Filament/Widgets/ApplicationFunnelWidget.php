<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\LineChartWidget;

class ApplicationFunnelWidget extends LineChartWidget
{
    public function getHeading(): string
    {
        return 'Application Funnel (Last 30 Days)';
    }

    protected function getData(): array
    {
        $statuses = ['new', 'reviewed', 'interview_scheduled', 'hired'];
        $data = [];

        foreach ($statuses as $status) {
            $data[] = Application::where('status', $status)
                ->where('created_at', '>=', now()->subDays(30))
                ->count();
        }

        return [
            'labels' => ['New', 'Reviewed', 'Interview', 'Hired'],
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $data,
                    'fill' => true,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'tension' => 0.4,
                ],
            ],
        ];
    }
}