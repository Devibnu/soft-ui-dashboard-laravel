<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Email reply API routes - NO CSRF, NO WEB MIDDLEWARE
Route::post('/adminui/request-quote/inbox/{id}/reply-email', [App\Http\Controllers\Admin\RequestQuoteInboxController::class, 'replyEmail']);
Route::post('/adminui/contact-messages/{id}/reply-email', [App\Http\Controllers\Admin\ContactMessageController::class, 'replyEmail']);
