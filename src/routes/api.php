<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/4/21, 11:27 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

Route::namespace('v1')->prefix('v1/openaip')->middleware('auth:api')->group(function () {
    Route::get('handel/{country}/{section?}/{action?}', function ($country, $section = null, $action = null) {
        return ['data' => (new \iLaravel\iOpenAip\Vendor\OpenAip($country, $section, $action))->_get()];
    });
    Route::apiResource('airports', 'AirportController', ['as' => 'api.iopenaip.airports']);
    Route::get('airports/import/{country}', 'AirportController@import')->name('api.iopenaip.airports.import');
});
