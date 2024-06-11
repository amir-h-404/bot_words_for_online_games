<?php

use App\Http\Controllers\wordController;
use Illuminate\Support\Facades\Route;

Route::get("/", [wordController::class, "welcome"])->name("welcome");
Route::get("/{botType}", [wordController::class, "lang"])->name("lang");
Route::post("/{botType}", [wordController::class, "words"])->name("words");
