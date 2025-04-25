<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class RecruiterPerformanceWidget extends TableWidget
{
    public function getHeading(): string
    {
        return 'Recruiter Performance';
    }

    protected function getTableQuery(): Builder
    {
        return User::query()
            ->where('role', 'recruiter')
            ->withCount(['applications as hired_count' => function($query) {
                $query->where('status', 'hired');
            }])
            ->withCount('applications')
            ->having('applications_count', '>', 0)
            ->orderBy('hired_count', 'desc');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->searchable(),
                
            TextColumn::make('applications_count')
                ->label('Total Apps'),
                
            TextColumn::make('hired_count')
                ->label('Hired'),
                
            TextColumn::make('conversion_rate')
                ->label('Conversion Rate')
                ->formatStateUsing(fn ($state) => $state.'%')
                ->getStateUsing(function (User $record) {
                    return $record->applications_count > 0 
                        ? round(($record->hired_count / $record->applications_count) * 100, 1)
                        : 0;
                }),
        ];
    }
}