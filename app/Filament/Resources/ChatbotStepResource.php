<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatbotStepResource\Pages;
use App\Filament\Resources\ConversationLogResource;
// use App\Filament\Resources\ChatbotStepResource\RelationManagers;
// use App\Filament\Resources\ChatbotStepResource\RelationManagers\ConversationLogsRelationManager;
use App\Models\ChatbotStep;
use App\Models\ChatbotFlow;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ChatbotStepResource extends Resource
{
    protected static ?string $model = ChatbotStep::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $modelLabel = 'Chatbot Step';

    protected static ?string $navigationGroup = 'Chatbot';

    protected static ?string $recordTitleAttribute = 'message_text';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Step Configuration')
                    ->schema([
                        Forms\Components\Select::make('flow_id')
                            ->relationship('flow', 'name')
                            ->label('Belongs to Flow')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\Toggle::make('is_active')
                                    ->default(true),
                            ]),
                            
                        Forms\Components\TextInput::make('step_order')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Step Content')
                    ->schema([
                        Forms\Components\Select::make('step_type')
                            ->options([
                                'greeting' => 'Greeting',
                                'question' => 'Question',
                                'file_request' => 'File Request',
                                'confirmation' => 'Confirmation',
                                'end' => 'End',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                // Set default response type based on step type
                                $set('expected_response_type', match($state) {
                                    'greeting' => 'none',
                                    'question' => 'text',
                                    'file_request' => 'file',
                                    'confirmation' => 'selection',
                                    'end' => 'none',
                                    default => 'none',
                                });
                            }),
                            
                        Forms\Components\RichEditor::make('message_text')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('The message that will be displayed to the user'),
                    ]),
                    
                Forms\Components\Section::make('Response Handling')
                    ->schema([
                        Forms\Components\Select::make('expected_response_type')
                            ->options([
                                'text' => 'Text',
                                'file' => 'File',
                                'selection' => 'Selection',
                                'none' => 'None',
                            ])
                            ->required()
                            ->live(),
                            
                        Forms\Components\KeyValue::make('options')
                            ->label('Response Options (for selection type)')
                            ->columnSpanFull()
                            ->visible(fn (Forms\Get $get) => $get('expected_response_type') === 'selection'),
                            
                        Forms\Components\KeyValue::make('validation_rules')
                            ->label('Validation Rules')
                            ->columnSpanFull()
                            ->visible(fn (Forms\Get $get) => in_array($get('expected_response_type'), ['text', 'file'])),
                            
                        Forms\Components\KeyValue::make('next_step_logic')
                            ->label('Next Step Logic')
                            ->columnSpanFull()
                            ->helperText('Define conditions for branching logic. Format: {"response_value": "next_step_id"}'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('step_order')
            ->defaultSort('flow_id', 'asc')
            ->defaultSort('step_order', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('flow.name')
                    ->label('Flow')
                    ->sortable()
                    ->searchable()
                    ->url(fn (ChatbotStep $record) => ChatbotFlowResource::getUrl('edit', ['record' => $record->flow_id])),
                    
                Tables\Columns\TextColumn::make('step_order')
                    ->sortable()
                    ->label('Order'),
                    
                Tables\Columns\TextColumn::make('step_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'greeting' => 'primary',
                        'question' => 'info',
                        'file_request' => 'warning',
                        'confirmation' => 'success',
                        'end' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('message_text')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->message_text),
                    
                Tables\Columns\TextColumn::make('expected_response_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'info',
                        'file' => 'warning',
                        'selection' => 'success',
                        'none' => 'gray',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('conversation_logs_count')
                    ->label('Interactions')
                    ->counts('conversationLogs')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('flow_id')
                    ->label('Flow')
                    ->relationship('flow', 'name')
                    ->searchable(),
                    
                Tables\Filters\SelectFilter::make('step_type')
                    ->options([
                        'greeting' => 'Greeting',
                        'question' => 'Question',
                        'file_request' => 'File Request',
                        'confirmation' => 'Confirmation',
                        'end' => 'End',
                    ]),
                    
                Tables\Filters\SelectFilter::make('expected_response_type')
                    ->options([
                        'text' => 'Text',
                        'file' => 'File',
                        'selection' => 'Selection',
                        'none' => 'None',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    // Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('logs')
                        ->label('View Logs')
                        ->icon('heroicon-o-chat-bubble-left-ellipsis')
                        ->url(fn (ChatbotStep $record) => ConversationLogResource::getUrl('index', ['step_id' => $record->id])),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // ConversationLogsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatbotSteps::route('/'),
            'create' => Pages\CreateChatbotStep::route('/create'),
            // 'view' => Pages\ViewChatbotStep::route('/{record}'),
            'edit' => Pages\EditChatbotStep::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(request()->has('flow_id'), function ($query) {
                $query->where('flow_id', request('flow_id'));
            });
    }
}