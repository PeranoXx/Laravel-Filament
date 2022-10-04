<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Form;

class AuthorRole extends Page
{
    protected static ?string $title = 'User Role Management';

    protected static ?string $navigationGroup = 'Filament Shield';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.author-role';

}
