<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->group(function () {

    Route::group(['prefix' => 'templates'], function () {
        Route::get('/GetMyTemplates', [App\Http\Controllers\Api\TemplatesController::class, 'GetMyTemplates']);
        Route::get('/GetTemplate/{template_id}', [App\Http\Controllers\Api\TemplatesController::class, 'GetTemplate']);
        Route::post('/SaveTemplate', [App\Http\Controllers\Api\TemplatesController::class, 'SaveTemplate']);
        Route::put('/UpdateTemplate', [App\Http\Controllers\Api\TemplatesController::class, 'UpdateTemplate']);
        Route::delete('/DeleteTemplate/{template_id}', [App\Http\Controllers\Api\TemplatesController::class, 'DeleteTemplate']);
    });

    Route::group(['prefix' => 'contacts'], function () {
        Route::get('/GetMyContacts', [App\Http\Controllers\Api\ContactsController::class, 'GetMyContacts']);
        Route::post('/SaveContact', [App\Http\Controllers\Api\ContactsController::class, 'SaveContact']);
        Route::put('/UpdateContact', [App\Http\Controllers\Api\ContactsController::class, 'UpdateContact']);
        Route::delete('/DetachContact/{contact_id}', [App\Http\Controllers\Api\ContactsController::class, 'DetachContact']);
    });
});
