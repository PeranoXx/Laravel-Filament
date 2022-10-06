<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateProduct extends CreateRecord
{
    use Translatable;
    protected static string $resource = ProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
        
    //     ddd($data);

    //     return $data;
    // }
}
