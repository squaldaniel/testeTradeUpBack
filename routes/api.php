<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViaCepController;

Route::middleware('localcors')->group(function () {
    Route::get('getcep/{cep}', [ViaCepController::class, 'getCep']);
});
