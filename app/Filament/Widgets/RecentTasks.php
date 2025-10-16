<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentTasks extends TableWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 2;
    protected string|int |array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Task::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('status'),
                TextColumn::make('priority')
                    ->badge()
                    ->color(function (string $state): string {
                        return match ($state) {
                            'low' => 'warning',
                            'high' => 'success',
                            'medium' => 'gray'
                        };
                    }),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('asignedUser.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('creator.name'),

                TextColumn::make('updator.name'),

                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
