<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class ManageSite extends SettingsPage
{
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = SiteSettings::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('site_name')
                ->required(),
            FileUpload::make('site_logo')
                ->avatar()
        ];
    }
}
