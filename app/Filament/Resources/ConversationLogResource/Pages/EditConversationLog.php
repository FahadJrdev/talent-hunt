<?php

namespace App\Filament\Resources\ConversationLogResource\Pages;

use App\Filament\Resources\ConversationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConversationLog extends EditRecord
{
    protected static string $resource = ConversationLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
