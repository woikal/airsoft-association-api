<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClubRequest;
use App\Models\Club;
use App\Models\Official;
use Filament\Forms\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ClubController extends Controller
{
    public function index()
    {
        return view('club.index', ['clubs' => Club::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param Club $club
     *
     * @return Response
     */
    public function show(Club $club)
    {
        return view('club.show', ['club' => $club]);
    }
    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('club.create', );
    }

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
            $official = Official::updateOrCreate([
                'first_name' => $parsedOfficial['first_name'],
                'last_name'  => $parsedOfficial['last_name'],
            ]);
            $club->officials()->append($official)->with([
                'start_at' => $parsedOfficial['start_at'],
                'end_at'   => $parsedOfficial['end_at'],
                'role'     => $parsedOfficial['role'],
            ]);
        }

        $club->save();

        return redirect('club.show', compact('club'));
    }
}
