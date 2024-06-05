<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Checklist\ChecklistController;
use App\Http\Controllers\Checklist\ChecklistItemController;
use Illuminate\Support\Facades\Route;

//authentication
Route::post('/login', LoginController::class)->name('login');
Route::post('/register', RegisterController::class)->name('register');

Route::middleware('auth:sanctum')->group(function () {
    //checklist
    Route::apiResource('checklist', ChecklistController::class)->except('show');

    //checklist item
    Route::put('checklist/{checklist}/item/rename/{checklistItem}', [ChecklistItemController::class, 'renameItem'])->name('checklist.item.rename');
    Route::apiResource('checklist/{checklist}/item', ChecklistItemController::class)->parameters([
        'item' => 'checklistItem'
    ]);
});
