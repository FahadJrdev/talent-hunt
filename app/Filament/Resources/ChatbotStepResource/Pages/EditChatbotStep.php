<?php

namespace App\Filament\Resources\ChatbotStepResource\Pages;

use App\Filament\Resources\ChatbotStepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChatbotStep extends EditRecord
{
    protected static string $resource = ChatbotStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
