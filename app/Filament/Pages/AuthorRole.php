<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Form;

class AuthorRole extends Page
{
    protected static ?string $title = NULL;

    protected static ?string $navigationGroup = 'Filament Shield';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.author-role';

    protected function getTitle(): string
    {
        return static::$title ?? __('User Role Management');
    }

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? __('User Role Management');
    }

    protected static function getNavigationGroup(): ?string
    {
        return static::$navigationGroup ?? __('Filament Shield');
    }

}
