<?php

namespace App\Filament\pages;

use App\Filament\Exports\projectExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\Contracts\ExportFormat;
use Filament\Actions\Exports\Enums\ExportFormat as EnumsExportFormat;
use Filament\Actions\Exports\Exporter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Dashboard extends \Filament\Pages\Dashboard
{

    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }
}
