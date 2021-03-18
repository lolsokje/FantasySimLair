<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeasonRequest;
use App\Http\Requests\UpdateSeasonRequest;
use App\Models\Championship;
use App\Models\Season;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class SeasonController extends Controller
{
    /**
     * @param Championship $championship
     * @return Renderable
     */
    public function create(Championship $championship): Renderable
    {
        return view('seasons.create', [
            'championship' => $championship
        ]);
    }

    /**
     * @param Season $season
     * @return Renderable
     */
    public function show(Season $season): Renderable
    {
        return view('seasons.show', [
            'season' => $season
        ]);
    }

    /**
     * @param Season $season
     * @return Renderable
     */
    public function edit(Season $season): Renderable
    {
        return view('seasons.edit', [
            'season' => $season
        ]);
    }

    /**
     * @param Season $season
     * @param UpdateSeasonRequest $request
     * @return RedirectResponse
     */
    public function update(Season $season, UpdateSeasonRequest $request): RedirectResponse
    {
        $season->update($request->except('_token'));

        return redirect(route('championships.show', [$season->championship]))->with('notice', 'Season results updated');
    }

    /**
     * @param Championship $championship
     * @param CreateSeasonRequest $request
     * @return RedirectResponse
     */
    public function store(Championship $championship, CreateSeasonRequest $request): RedirectResponse
    {
        $championship->seasons()->create($request->except('_token'));

        return redirect(route('championships.show', [$championship]))->with('notice', 'Season results added');
    }
}
