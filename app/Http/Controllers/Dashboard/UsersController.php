<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('dashboard.users.index', [
            'team' => request()->user()->currentTeam,
        ]);
    }

    public function create()
    {
        return view('dashboard.users.create', [
            'team' => request()->user()->currentTeam,
        ]);
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'), [
            'team' => request()->user()->currentTeam,
        ]);
    }
}
