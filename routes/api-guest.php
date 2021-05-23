<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'guest',
    'namespace' => 'GuestDomain',
], function () {
    Route::apiResource('test', 'TestController');
    Route::apiResource('tasks', 'TasksController');

    Route::get('tasks/{task}/attachments', 'TaskAttachmentsController@index');
    Route::post('tasks/{task}/attachments', 'TaskAttachmentsController@store');
    Route::delete('tasks/{task}/attachments/{attachment}', 'TaskAttachmentsController@destroy');
});
