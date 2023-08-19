<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClubRequest;
use App\Models\Club;
use App\Models\Official;
use Illuminate\Http\RedirectResponse;

class ClubController extends Controller
{

    public function store(StoreClubRequest $request): RedirectResponse
    {
        $validated = collect($request->validated());

        $club = new Club($validated->only([

            'recorded_at',
            'authority',
            'name',
            'acronym',
            'zvr',
            'headquarter',
            'c/o',
            'postalAddress',
            'foundedAt',
        ])->toArray());

        foreach ($validated->pluck('officials') as $parsedOfficial) {
            $official = Official::findOrCreate([
                'first_name' => $parsedOfficial['first_name'],
                'last_name'  => $parsedOfficial['last_name'],
            ]);
            $club->officials()->append($official)->with([
                'start_at' => $parsedOfficial['start_at'],
                'end_at'   => $parsedOfficial['end_at'],
                'role'     => $parsedOfficial['role'],
            ]);
        }

        $club->persist();

        return redirect('club.show', compact('club'));
    }
}
