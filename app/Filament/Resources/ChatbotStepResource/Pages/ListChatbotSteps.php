<?php

namespace App\Filament\Resources\ChatbotStepResource\Pages;

use App\Filament\Resources\ChatbotStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChatbotSteps extends ListRecords
{
    protected static string $resource = ChatbotStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
