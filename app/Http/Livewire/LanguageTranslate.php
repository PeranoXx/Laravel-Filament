<?php

namespace App\Http\Livewire;

use App\Models\LanguageLine;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use io3x1\FilamentTranslations\Models\Translation;
use Livewire\Component;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageTranslate extends Component
{
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
        // dd($langs);
        try {
            foreach ($langs as $key => $lang) {
                $langs[$key]['text'] = ['en' => $lang['key'], 'es' => $tr->translate($lang['key'])];
                $lang->save();
            }
            Notification::make()
                ->title('Language Translated Successfully!')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
            ->title($e->getMessage())
            ->error()
            ->send();
        }
    }
}
