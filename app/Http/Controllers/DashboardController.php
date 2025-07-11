<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Extract;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return response()->view('dashboard.index', [
            'extracts_count' => Extract::all()->count(),
            'clubs_count'    => Club::all()->count(),
        ]);
    }

    public function create(): Response
    {
        return response()->view('dashboard.create', [
            'extracts_count' => Extract::all()->count(),
            'clubs_count'    => Club::all()->count(),
        ]);
    }
}
