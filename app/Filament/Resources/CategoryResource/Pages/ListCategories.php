<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use phpDocumentor\Reflection\Types\Null_;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ListCategories extends ListRecords
{
    use Translatable;
    protected static ?string $title = Null;

    protected static string $resource = CategoryResource::class;

    protected function getTitle(): string
    {
        return static::$title ?? __('Categories');
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
