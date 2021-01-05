<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => true,'reset' => false,'verify' => false,]);

Route::get('/', [App\Http\Controllers\ViewsController::class, 'website'])->name('website');
Route::get('/home', [App\Http\Controllers\ViewsController::class, 'index'])->name('home');

Route::group(['prefix' => 'attachments'], function () {
    Route::get('/GetFile/{file_id}', [App\Http\Controllers\Api\AttachmentsController::class, 'GetFile'])->name('GetFile');
});