<?php

namespace App\Filament\Resources\ConversationLogResource\Pages;

use App\Filament\Resources\ConversationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConversationLogs extends ListRecords
{
    protected static string $resource = ConversationLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
