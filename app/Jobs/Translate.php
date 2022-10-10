<?php

namespace App\Jobs;

use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use io3x1\FilamentTranslations\Models\Translation;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Translate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // UPDATE `language_lines` SET `text`='[]'
    // public $tries = 3;
    // public $timeout = 6000;
    // public $sleep = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $locales = config('filament-translations.locals');
        $langs = Translation::where('text', DB::raw("json_array()"))->get();
        try {
            foreach ($langs as $key => $lang) {
                $langs[$key]['text'] = $this->test($lang['key'], $locales);
                // dd($lang);
                $lang->save();
            }
        } catch (\Exception $e) {
        }
    }

    public function test($text, $locales){
        $t = [];
        foreach ($locales as $key => $locale) {
            $t[$locale] = GoogleTranslate::trans($text, $locale);//$tr->setTarget('ka')->translate('Goodbye')];
        }
        return $t;
    }
}
