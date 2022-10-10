<?php

// namespace io3x1\FilamentTranslations\Resources\TranslationResource\Pages;
namespace App\Filament\Resources\TranslationResource\Pages;

use App\Jobs\Translate;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\DB;
use io3x1\FilamentTranslations\Models\Translation;
use io3x1\FilamentTranslations\Services\SaveScan;
use io3x1\FilamentTranslations\Resources\TranslationResource;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ManageTranslations extends ManageRecords
{
    protected static string $resource = TranslationResource::class;

    protected function getTitle(): string
    {
        return __('Translation');
    }

    protected function getActions(): array
    {
        return [
            ButtonAction::make('scan')
                ->icon('heroicon-o-document-search')
                ->action('scan')
                ->label(__('Scan For New Language')),
            ButtonAction::make('auto-translate')
                ->icon('heroicon-o-refresh')
                ->action('autoTranslate')
                ->label(__('Auto Translate')),
        ];
    }

    public function scan()
    {
        $scan = new SaveScan();
        $scan->save();

        $this->notify('success', __('Translations list has been updated'));
    }

    // public function autoTranslate()
    // {
    //     // $tr = new GoogleTranslate();
    //     // $tr->setSource('en');
    //     // $tr->setTarget('es');
    //     $langs = Translation::where('text', DB::raw("json_array()"))->get();
    //     try {
    //         foreach ($langs as $key => $lang) {
    //             // dd($lang);
    //             $langs[$key]['text'] = ['en'=> GoogleTranslate::trans($lang['key'], 'en')];
    //             $lang->save();
    //         }
    //         Notification::make()->title('Language Translated Successfully!')->success()->send();
    //     } catch (\Exception $e) {
    //         Notification::make()->title($e->getMessage())->danger()->send();
    //     }
    // }
    public function autoTranslate(){
        try {
            Translate::dispatch();
            Notification::make()->title('Language Translating Starts in Background!')->success()->send();
        } catch (\Exception $e) {
            Notification::make()->title($e->getMessage())->error()->send();
        }

    }
}
