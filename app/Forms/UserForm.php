<?php
 
namespace App\Forms;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\HtmlString;
use RalphJSmit\Tall\Interactive\Forms\Form;
 
class UserForm extends Form {
 
    public function getFormSchema(): array
    {
        return [
            TextInput::make('email')
            ->label('Enter your email')
            ->placeholder('john@example.com')
            ->required(),
        Grid::make()->schema([
            TextInput::make('firstname')
                ->label('Enter your first name')
                ->placeholder('John'),
            TextInput::make('lastname')
                ->label('Enter your last name')
                ->placeholder('Doe'),
        ]),
        TextInput::make('password')
            ->label('Choose a password')
            ->password(),
        MarkdownEditor::make('why')
            ->label('Why do you want an account?'),
        Placeholder::make('open_child_modal')
            ->disableLabel()
            ->content(
                new HtmlString('Click <button onclick="Livewire.emit(\'modal:open\', \'create-user-child\')" type="button" class="text-primary-500">here</button> to open a child modal🤩')
            ),

        ];
    }
 
    public function submit(): void
    {
        //
    }
 
    public function mount(): void
    {
        //
    }
 
    /** Only applicable for Modals and SlideOvers */
    public function onOpen(): void
    {
        //
    }
}