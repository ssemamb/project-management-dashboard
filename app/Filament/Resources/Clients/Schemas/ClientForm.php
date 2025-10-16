<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('address')
                    ->default(null),
                Select::make('status')
                    ->options(['active' => 'Active', 'in_active' => 'In active'])
                    ->default('active')
                    ->required(),
                Select::make('created_by')
                    ->relationship('creator', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('updated_by')
                    ->relationship('updator', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
