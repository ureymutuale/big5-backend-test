<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user',
    'namespace' => 'UserDomain',
    'middleware' => ['auth:api', 'user']
], function () {
});


/* Public________________________________________________________________ */
Route::group([
    'prefix' => 'user',
    'namespace' => 'UserDomain',
], function () {
});
