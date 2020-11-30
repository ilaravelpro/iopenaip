<?php

Route::namespace('v1')->prefix('v1/openaip')->group(function () {
    Route::get('handel/{country}/{section?}/{action?}', function ($country, $section = null, $action = null) {
        return ['data' => (new \iLaravel\iOpenAip\Vendor\OpenAip($country, $section, $action))->_get()];
    });
    Route::apiResource('airports', 'AirportController', ['as' => 'api.iopenaip.airports']);
    Route::get('airports/import/{country}', 'AirportController@import')->name('api.iopenaip.airports.import');
});
