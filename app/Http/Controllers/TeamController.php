<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use App\Models\Official;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    public function index(): Response
    {
        return view('team.index', ['teams' => Team::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     *
     * @return Response
     */
    public function show(Team $team): Response
    {
        return view('teams.show', ['show' => $team]);
    }

    public function store(StoreTeamRequest $request): RedirectResponse
    {
        $validated = collect($request->validated());

        $team = Team::make($validated->only([
            'recorded_at',
            'authority',
            'name',
            'acronym',
            'club_id',
            'headquarter',
            'c/o',
            'postalAddress',
            'foundedAt',
        ]));

        foreach ($validated->pluck('officials') as $parsedOfficial) {
            $official = Official::findOrCreate([
                'first_name' => $parsedOfficial['first_name'],
                'last_name'  => $parsedOfficial['last_name'],
            ]);
            $team->officials()->append($official)->with([
                'start_at' => $parsedOfficial['start_at'],
                'end_at'   => $parsedOfficial['end_at'],
                'role'     => $parsedOfficial['role'],
            ]);
        }

        $team->persist();

        return redirect('club.show', compact('team'));
    }
}
