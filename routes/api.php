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

    Route::group(['prefix' => 'emails'], function () {
        Route::get('/GetAllEmails', [App\Http\Controllers\Api\EmailsController::class, 'GetAllEmails']);
        Route::get('/GetEmail/{email_id}', [App\Http\Controllers\Api\EmailsController::class, 'GetEmail']);

        Route::get('/GetAllMyEmails', [App\Http\Controllers\Api\EmailsController::class, 'GetAllMyEmails']);
        Route::get('/GetAllMyInboxEmails', [App\Http\Controllers\Api\EmailsController::class, 'GetAllMyInboxEmails']);
        Route::get('/GetAllMySentEmails', [App\Http\Controllers\Api\EmailsController::class, 'GetAllMySentEmails']);

        Route::post('/SaveAndSendEmail', [App\Http\Controllers\Api\EmailsController::class, 'SaveAndSendEmail']);

        Route::get('/SearchBySender/{search}', [App\Http\Controllers\Api\EmailsController::class, 'SearchBySender']);
    });

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
