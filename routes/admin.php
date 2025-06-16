<?php

Route::get('/', function () {
    return \Inertia\Inertia::render("admin/AdminDashboard");
})->name("index");

Route::get("/users", [\App\Http\Controllers\Admin\Users\UsersController::class, 'index'])->name("users.index");
