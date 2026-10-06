<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InwardOutwardController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Material Inventory machine test:
|   Step 1 - Category master CRUD + Material add form
|   Step 2 - Inward/Outward quantity form
|   Step 3 - Manage page listing materials with current balance
|
*/

Route::redirect('/', '/materials');

// Step 1a: Category master CRUD.
Route::resource('categories', CategoryController::class)->except(['show']);

// Step 1b (create) + Step 3 (index/edit/destroy): Materials.
Route::resource('materials', MaterialController::class)->except(['show']);
Route::get('materials-by-category', [MaterialController::class, 'byCategory'])->name('materials.by-category');

// Step 2: Inward/Outward quantity entry.
Route::get('inward-outward/create', [InwardOutwardController::class, 'create'])->name('inward-outward.create');
Route::post('inward-outward', [InwardOutwardController::class, 'store'])->name('inward-outward.store');
