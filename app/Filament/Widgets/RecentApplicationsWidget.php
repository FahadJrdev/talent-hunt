<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class RecentApplicationsWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    
    public function getHeading(): string
    {
        return 'Recent Applications';
    }

    protected function getTableQuery(): Builder
    {
        return Application::query()
            ->with(['jobPosition', 'user'])
            ->latest()
            ->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('created_at')
                ->label('Date')
                ->dateTime('M j, Y g:i A')
                ->sortable(),
                
            TextColumn::make('applicant_name')
                ->label('Applicant')
                ->searchable(),
                
            TextColumn::make('jobPosition.title')
                ->label('Position')
                ->url(fn (Application $record) => 
                    $record->job_position_id ? route('filament.admin.resources.job-positions.edit', $record->job_position_id) : null
                ),
                
            TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'new' => 'gray',
                    'reviewed' => 'info',
                    'interview_scheduled' => 'warning',
                    'rejected' => 'danger',
                    'hired' => 'success',
                }),
        ];
    }
}