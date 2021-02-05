<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/2/21, 8:12 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();
        if (iopenaip('policies.airports', true)) {
            Gate::resource('iopenaip.airports', 'iLaravel\iOpenAip\iApp\Policies\AirportPolicy');
            Gate::define('iopenaip.airports.import', 'iLaravel\iOpenAip\iApp\Policies\AirportPolicy@import');
        }
    }
}
