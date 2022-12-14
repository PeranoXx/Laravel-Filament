<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            ImportAction::make()
                ->fields([
                    ImportField::make('name')->label('name'),
                    ImportField::make('email')->label('Email'),
                    ImportField::make('password')->label('Password'),
                ])
        ];
    }
}
