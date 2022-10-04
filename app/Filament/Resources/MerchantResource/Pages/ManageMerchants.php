<?php

namespace App\Filament\Resources\MerchantResource\Pages;

use App\Filament\Resources\MerchantResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Illuminate\Support\Str;

class ManageMerchants extends ManageRecords
{
    protected static string $resource = MerchantResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            ImportAction::make()
                ->fields([
                    ImportField::make('name')->label('name')->required()
                    // ->rules('email')
                    ->mutateBeforeCreate(fn($record) => Str::upper($record))
                    ,
                    ImportField::make('description')->label('Description')->required(),
                    ImportField::make('website')->label('Website')->required(),
                    ImportField::make('domain_name')->label('Domain Name')->required(),
                ])
        ];
    }
}
