<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MenuController;



Route::get('/', [MenuController::class, 'index'])->name('landing');

//maps
Route::get('/maps', [MapController::class, 'index'])->name('maps.index');
