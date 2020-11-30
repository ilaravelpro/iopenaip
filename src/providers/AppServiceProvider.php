<?php

namespace iLaravel\iOpenAip\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(iopenaip_path('config/iopenaip.php'), 'ilaravel.iopenaip');

        if($this->app->runningInConsole())
        {
            if (iopenaip('database.migrations.include', true)) $this->loadMigrationsFrom(iopenaip_path('database/migrations'));
        }
    }

    public function register()
    {
        parent::register();
    }
}
