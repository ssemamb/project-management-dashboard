<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('descripton')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->disk(name: 'public')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->directory('tasks')
                    ->image(),
                ToggleButtons::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'on_hold' => 'On hold',
                        'in_progress' => 'In progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->grouped()
                    ->default('pending')
                    ->required(),
                ToggleButtons::make('priority')
                    ->options(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'])
                    ->colors([
                        'low' => 'success',
                        'medium' => 'danger',
                        'high' => 'warning'
                    ])
                    ->grouped()
                    ->icons([
                        'low' => Heroicon::OutlinedPencil,
                        'high' => Heroicon::OutlinedCircleStack,
                        'medium' => Heroicon::OutlinedCheckCircle
                    ])
                    ->default('medium')
                    ->required(),
                DatePicker::make('due_date'),
                Select::make('asigned_user_id')
                    ->relationship('asignedUser', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('project_id')
                    ->required()
                    ->relationship('project', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('created_by')
                    ->required()
                    ->relationship('creator', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('updated_by')
                    ->required()
                    ->relationship('updator', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
