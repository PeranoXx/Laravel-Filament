<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditProduct extends EditRecord
{
    use Translatable;
    protected static string $resource = ProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }

//     protected function mutateFormDataBeforeFill(array $data): array
// {
//     $data['user_id'] = auth()->id();
//     dd($data);
//     return $data;
// }
}
