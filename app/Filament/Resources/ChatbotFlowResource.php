<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatbotFlowResource\Pages;
use App\Filament\Resources\ChatbotStepResource;
// use App\Filament\Resources\ChatbotFlowResource\RelationManagers;
// use App\Filament\Resources\ChatbotFlowResource\RelationManagers\ChatbotStepsRelationManager;
use App\Models\ChatbotFlow;
use App\Models\JobPosition;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ChatbotFlowResource extends Resource
{
    protected static ?string $model = ChatbotFlow::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $modelLabel = 'Chatbot Flow';

    protected static ?string $navigationGroup = 'Chatbot';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Flow Information')
                    ->schema([
                        Forms\Components\Select::make('job_position_id')
                            ->relationship('jobPosition', 'title')
                            ->label('Associated Job Position')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('title')
                                    ->required(),
                                Forms\Components\TextInput::make('department')
                                    ->required(),
                            ])
                            ->helperText('Leave blank for general flows'),
                            
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->helperText('A descriptive name for this flow'),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->inline(false)
                            ->label('Active Flow')
                            ->helperText('Only active flows will be available to users'),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Ownership')
                    ->schema([
                        Forms\Components\Select::make('created_by')
                            ->relationship('createdBy', 'name')
                            ->label('Created By')
                            ->default(auth()->id())
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->hiddenOn('create'), // Only show on edit/view
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (ChatbotFlow $record) => $record->jobPosition?->title),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable()
                    ->url(fn (ChatbotFlow $record) => UserResource::getUrl('edit', ['record' => $record->created_by])),
                    
                Tables\Columns\TextColumn::make('chatbot_steps_count')
                    ->label('Steps')
                    ->counts('chatbotSteps')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('job_position_id')
                    ->label('Job Position')
                    ->relationship('jobPosition', 'title')
                    ->searchable(),
                    
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->trueLabel('Active flows')
                    ->falseLabel('Inactive flows')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    // Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('manage_steps')
                        ->label('Manage Steps')
                        ->icon('heroicon-o-queue-list')
                        ->url(fn (ChatbotFlow $record) => ChatbotStepResource::getUrl('index', ['flow_id' => $record->id])),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => true])),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // ChatbotStepsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatbotFlows::route('/'),
            'create' => Pages\CreateChatbotFlow::route('/create'),
            // 'view' => Pages\ViewChatbotFlow::route('/{record}'),
            'edit' => Pages\EditChatbotFlow::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('chatbotSteps');
    }
}