<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->get("/test", fn() => Inertia::render("Test"))->name('test');
//Route::middleware(['auth', 'verified'])->get("/admin", fn() => Inertia::render("admin/AdminDashboard"))->name('admin.dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
