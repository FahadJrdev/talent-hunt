<?php

namespace App\Filament\Widgets;

use App\Models\ChatbotFlow;
use App\Models\ChatbotStep;
use Filament\Widgets\DoughnutChartWidget;
use Illuminate\Support\Facades\DB;

class ChatbotFlowUsageWidget extends DoughnutChartWidget
{
    public function getHeading(): string
    {
        return 'Chatbot Flow Usage (Last 30 Days)';
    }

    protected function getData(): array
    {
        // Get flows with their conversation counts
        $flows = ChatbotFlow::query()
            ->select([
                'chatbot_flows.id',
                'chatbot_flows.name',
                DB::raw('COUNT(conversation_logs.id) as conversation_count')
            ])
            ->join('chatbot_steps', 'chatbot_steps.flow_id', '=', 'chatbot_flows.id')
            ->join('conversation_logs', 'conversation_logs.step_id', '=', 'chatbot_steps.id')
            ->where('conversation_logs.created_at', '>=', now()->subDays(30))
            ->groupBy('chatbot_flows.id', 'chatbot_flows.name')
            ->orderBy('conversation_count', 'desc')
            ->limit(5)
            ->get();

        return [
            'labels' => $flows->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Conversations',
                    'data' => $flows->pluck('conversation_count'),
                    'backgroundColor' => ['#3b82f6', '#6366f1', '#8b5cf6', '#ec4899', '#f43f5e'],
                    'borderWidth' => 0,
                ],
            ],
        ];
    }
}