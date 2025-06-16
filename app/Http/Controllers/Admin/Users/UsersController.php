<?php

namespace App\Http\Controllers\Admin\Users;

use Inertia\Inertia;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(): \Inertia\Response
    {
        $users = User::query()
            ->where("is_business", true)
            ->paginate(15);

        return Inertia::render("admin/User/UsersIndex", [
            "users" => $users
        ]);
    }
}
