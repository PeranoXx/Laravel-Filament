<?php

namespace App\Http\Livewire;

use App\Models\LanguageLine;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\DB;
use io3x1\FilamentTranslations\Models\Translation;
use Livewire\Component;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageTranslate extends Component
{
    protected function getActions(): array
    {
        return [
            Action::make('settings')->action('openSettingsModal'),
        ];
    }

    public function render()
    {
        return view('livewire.language-translate');
    }

    public function translate()
    {
        $tr = new GoogleTranslate();
        $tr->setSource('en');
        $tr->setTarget('es');
        $langs = Translation::where('text', DB::raw("json_array()"))->get();
        try {
            foreach ($langs as $key => $lang) {
                $langs[$key]['text'] = ['en' => $lang['key'], 'es' => $tr->translate($lang['key'])];
                $lang->save();
            }
            
        } catch (\Exception $e) {
            
        }
    }
}
