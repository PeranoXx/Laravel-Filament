<?php

namespace App\Providers;

use App\Filament\Resources\TranslationResource\Pages\ManageTranslations;
use Illuminate\Support\ServiceProvider;
use io3x1\FilamentTranslations\Resources\TranslationResource\Pages\ManageTranslations as PagesManageTranslations;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PagesManageTranslations::class, ManageTranslations::class);
    }
}
