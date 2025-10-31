<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Route::post('duitku/create', 'Webkul\\Duitku\\Http\\Controllers\\PaymentController@create')->name('duitku.gateway.create');
    Route::post('duitku/webhook', 'Webkul\\Duitku\\Http\\Controllers\\PaymentController@webhook')->name('duitku.gateway.webhook');
});
