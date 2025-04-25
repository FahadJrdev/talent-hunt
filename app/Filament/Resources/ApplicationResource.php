<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
// use App\Filament\Resources\ApplicationResource\RelationManagers;
// use App\Filament\Resources\ApplicationResource\RelationManagers\ConversationLogsRelationManager;
use App\Models\Application;
use App\Models\JobPosition;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'Job Application';

    protected static ?string $navigationGroup = 'Recruitment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Application Details')
                    ->schema([
                        Forms\Components\Select::make('job_position_id')
                            ->relationship('jobPosition', 'title')
                            ->label('Job Position')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('title')
                                    ->required(),
                                Forms\Components\TextInput::make('department')
                                    ->required(),
                            ]),
                            
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('User Account')
                            ->searchable()
                            ->preload()
                            ->helperText('Leave blank if applicant doesn\'t have an account'),
                            
                        Forms\Components\TextInput::make('applicant_name')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('applicant_email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('applicant_phone')
                            ->tel()
                            ->maxLength(255),
                    ])->columns(2),
                
                Forms\Components\Section::make('Application Documents')
                    ->schema([
                        Forms\Components\FileUpload::make('cv_file_path')
                            ->label('CV/Resume')
                            ->directory('applications/cvs')
                            ->downloadable()
                            ->openable(),
                            
                        Forms\Components\KeyValue::make('additional_info')
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Application Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'new' => 'New',
                                'reviewed' => 'Reviewed',
                                'interview_scheduled' => 'Interview Scheduled',
                                'rejected' => 'Rejected',
                                'hired' => 'Hired',
                            ])
                            ->required()
                            ->default('new')
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('last_status_change', now());
                            }),
                            
                        Forms\Components\DateTimePicker::make('last_status_change')
                            ->disabled(),
                            
                        Forms\Components\RichEditor::make('notes')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jobPosition.title')
                    ->label('Job Position')
                    ->sortable()
                    ->searchable()
                    ->url(fn (Application $record) => JobPositionResource::getUrl('edit', ['record' => $record->job_position_id])),
                    
                Tables\Columns\TextColumn::make('applicant_name')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('applicant_email')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'gray',
                        'reviewed' => 'info',
                        'interview_scheduled' => 'warning',
                        'rejected' => 'danger',
                        'hired' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Account')
                    ->url(fn (Application $record) => $record->user_id ? UserResource::getUrl('edit', ['record' => $record->user_id]) : null),
                    
                Tables\Columns\TextColumn::make('last_status_change')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('job_position_id')
                    ->label('Job Position')
                    ->relationship('jobPosition', 'title')
                    ->searchable(),
                    
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'reviewed' => 'Reviewed',
                        'interview_scheduled' => 'Interview Scheduled',
                        'rejected' => 'Rejected',
                        'hired' => 'Hired',
                    ]),
                    
                Tables\Filters\Filter::make('has_user_account')
                    ->label('Has User Account')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('user_id')),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download_cv')
                    ->label('Download CV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Application $record) => asset('storage/' . $record->cv_file_path))
                    ->hidden(fn (Application $record) => empty($record->cv_file_path)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_as_reviewed')
                        ->label('Mark as Reviewed')
                        ->icon('heroicon-o-eye')
                        ->action(fn (Collection $records) => $records->each->update([
                            'status' => 'reviewed',
                            'last_status_change' => now(),
                        ])),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\ConversationLogsRelationManager::class,
            // Add other relation managers here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            // 'view' => Pages\ViewApplication::route('/{record}'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}