<?php

namespace App\Http\Controllers\AdminUser;

use App\Http\Controllers\Controller;

final class AdminUserCreateController extends Controller
{
    public function __invoke()
    {
        return view('admin.users.create');
    }
}