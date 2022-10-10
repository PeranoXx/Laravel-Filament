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

    protected function getTitle(): string
    {
        return static::$title ?? __('Manage Site');
    }

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? __('Manage Site');
    }

    protected static function getNavigationGroup(): ?string
    {
        return static::$navigationGroup ?? __('Setting');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('site_name')->label(__('Site Name'))
                ->required(),
            FileUpload::make('site_logo')->label(__('Site Logo'))
                ->avatar()->required()
        ];
    }
}
