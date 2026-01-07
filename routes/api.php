<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;

Route::post('/webhooks/{source}', [WebhookController::class, 'handle'])->name('api.webhooks');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
