<?php

namespace App\Http\Controllers;

use App\Models\Extract;
use Illuminate\Http\Response;

class ParseTeamController extends Controller
{
    public function __invoke(Extract $extract): Response
    {
        return response()->view('parse.create');
    }
}
