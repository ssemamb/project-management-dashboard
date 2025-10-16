<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                DateTimePicker::make('start_date'),
                DateTimePicker::make('end_date'),
                FileUpload::make('image_path')
                    ->disk(name: 'public')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->image(),
                ToggleButtons::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'on_hold' => 'On hold',
                        'in_progress' => 'In progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->colors([
                        'pending' => 'secondary',
                        'in_progress' => 'info',
                        'on_hold' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger'
                    ])
                    ->grouped()
                    ->default('pending')
                    ->required(),
                select::make('created_by')
                    ->relationship('creator', 'name')
                    ->searchable()
                    ->preload()
                    ->default(Auth::user()->id)
                    ->disabled()
                    ->dehydrated(condition: true)
                    ->required(),
                Select::make('updated_by')
                    ->relationship('updator', 'name')
                    ->searchable()
                    ->disabled()
                    ->default(Auth::user()->id)
                    ->dehydrated(condition: true)
                    ->preload()
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('category_id')
                    ->searchable()
                    ->preload()
                    ->relationship('category', 'name')
                    ->required(),
            ]);
    }
}
