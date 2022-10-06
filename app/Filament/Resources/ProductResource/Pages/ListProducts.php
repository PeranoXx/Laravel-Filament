<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Pages\Actions;
use Filament\Pages\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
use Konnco\FilamentSafelyDelete\Pages\Concerns\HasRevertableRecord;

class ListProducts extends ListRecords
{
    use HasRevertableRecord;
    use Translatable;
    protected static string $resource = ProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return ProductResource::getWidgets();
    }
}
