<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'guest',
    'namespace' => 'GuestDomain',
], function () {
    Route::apiResource('test', 'TestController');
});
