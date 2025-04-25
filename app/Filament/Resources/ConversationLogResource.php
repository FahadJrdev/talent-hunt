<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConversationLogResource\Pages;
use App\Models\Application;
use App\Models\ChatbotStep;
use App\Models\ConversationLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ConversationLogResource extends Resource
{
    protected static ?string $model = ConversationLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $modelLabel = 'Conversation Log';

    protected static ?string $navigationGroup = 'Chatbot';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Conversation Details')
                    ->schema([
                        Forms\Components\Select::make('application_id')
                            ->relationship('application', 'applicant_name')
                            ->label('Application')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\Select::make('job_position_id')
                                    ->relationship('jobPosition', 'title')
                                    ->required(),
                                Forms\Components\TextInput::make('applicant_name')
                                    ->required(),
                                Forms\Components\TextInput::make('applicant_email')
                                    ->email()
                                    ->required(),
                            ]),
                            
                        Forms\Components\Select::make('step_id')
                            ->relationship('step', 'message_text')
                            ->label('Chatbot Step')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn (ChatbotStep $record) => "{$record->flow->name} - Step {$record->step_order}: {$record->message_text}"),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Conversation Content')
                    ->schema([
                        Forms\Components\Textarea::make('user_message')
                            ->label('User Message')
                            ->columnSpanFull()
                            ->rows(3),
                            
                        Forms\Components\Textarea::make('bot_message')
                            ->label('Bot Response')
                            ->columnSpanFull()
                            ->rows(3),
                    ]),
                    
                Forms\Components\Section::make('File Upload')
                    ->schema([
                        Forms\Components\Toggle::make('file_uploaded')
                            ->label('File Attached?')
                            ->reactive(),
                            
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Uploaded File')
                            ->directory('conversation-files')
                            ->downloadable()
                            ->openable()
                            ->visible(fn (Forms\Get $get) => $get('file_uploaded')),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Session')
                    ->schema([
                        Forms\Components\TextInput::make('session_id')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('application.applicant_name')
                    ->label('Applicant')
                    ->searchable()
                    ->sortable()
                    ->url(fn (ConversationLog $record) => $record->application_id ? ApplicationResource::getUrl('edit', ['record' => $record->application_id]) : null),
                    
                Tables\Columns\TextColumn::make('step.flow.name')
                    ->label('Flow')
                    ->searchable()
                    ->sortable()
                    ->url(fn (ConversationLog $record) => $record->step_id ? ChatbotFlowResource::getUrl('edit', ['record' => $record->step->flow_id]) : null),
                    
                Tables\Columns\TextColumn::make('step.message_text')
                    ->label('Step')
                    ->limit(30)
                    ->tooltip(fn (ConversationLog $record) => $record->step?->message_text),
                    
                Tables\Columns\TextColumn::make('user_message')
                    ->label('User Said')
                    ->limit(30)
                    ->tooltip(fn (ConversationLog $record) => $record->user_message)
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('bot_message')
                    ->label('Bot Replied')
                    ->limit(30)
                    ->tooltip(fn (ConversationLog $record) => $record->bot_message),
                    
                Tables\Columns\IconColumn::make('file_uploaded')
                    ->label('File')
                    ->boolean()
                    ->trueIcon('heroicon-o-paper-clip')
                    ->falseIcon(''),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('M j, Y g:i A')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('application_id')
                    ->label('Application')
                    ->relationship('application', 'applicant_name')
                    ->searchable(),
                    
                Tables\Filters\SelectFilter::make('step_id')
                    ->label('Chatbot Step')
                    ->relationship('step', 'message_text')
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(fn (ChatbotStep $record) => "{$record->flow->name} - Step {$record->step_order}: {$record->message_text}"),
                    
                Tables\Filters\Filter::make('has_file')
                    ->label('With File Upload')
                    ->query(fn (Builder $query): Builder => $query->where('file_uploaded', true)),
                    
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when($data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('download_file')
                    ->label('Download File')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (ConversationLog $record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                    ->hidden(fn (ConversationLog $record) => !$record->file_uploaded),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConversationLogs::route('/'),
            'create' => Pages\CreateConversationLog::route('/create'),
            // 'view' => Pages\ViewConversationLog::route('/{record}'),
            'edit' => Pages\EditConversationLog::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(request()->has('application_id'), function ($query) {
                $query->where('application_id', request('application_id'));
            })
            ->when(request()->has('step_id'), function ($query) {
                $query->where('step_id', request('step_id'));
            });
    }
}