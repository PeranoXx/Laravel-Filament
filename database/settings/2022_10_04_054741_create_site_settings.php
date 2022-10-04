<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSiteSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.site_name', '');
        $this->migrator->add('site.site_logo', '');
    }
}
