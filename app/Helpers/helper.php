<?php

use App\Settings\SiteSettings;

function getSiteName(){
    return app(SiteSettings::class)->site_name;
}

function getSiteLogo(){
    return app(SiteSettings::class)->site_logo;
}