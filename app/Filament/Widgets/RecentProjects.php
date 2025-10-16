<?php

namespace App\Filament\Widgets;

use App\Filament\Exports\projectExporter;
use App\Models\Project;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class RecentProjects extends TableWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 1;
    protected  string|int|array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Project::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(
                        function (string $state): string {
                            return match ($state) {
                                'cancelled' => 'warning',
                                'completed' => 'success',
                                'on_hold' => 'gray',
                                'in_progress' => 'success'
                            };
                        }
                    ),
                TextColumn::make('creator.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('updator.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([

                ExportAction::make()
                    ->exporter(projectExporter::class)
                    ->formats([
                        ExportFormat::Csv

                    ]),
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
