<?php

namespace App\Http\Livewire;

use App\Models\ApplyForAuthor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ApplyForAuthorForm extends Component implements HasForms
{
    use InteractsWithForms;

    public $description = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('description')->required()->label('Tell us about you.')
        ];
    }

    public function submit()
    {

        // dd($this->description);
        $data = $this->form->getState();
        $data['user_id'] = Auth::user()->id;
        ApplyForAuthor::create($data);
        Notification::make()
            ->title('Your Application is in review')
            ->success()
            ->send();

        return redirect()->route('dashboard');
            
    }
    public function render()
    {
        return view('livewire.apply-for-author-form');
    }
}
