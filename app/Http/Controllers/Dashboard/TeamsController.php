<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Team;

class TeamsController extends Controller
{
    public function index()
    {
        return view('dashboard.teams.index');
    }

    public function create()
    {
        return view('dashboard.teams.create');
    }

    public function edit(Team $team)
    {
        return view('dashboard.teams.edit', compact('team'));
    }
}
