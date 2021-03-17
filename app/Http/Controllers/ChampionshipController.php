<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChampionshipRequest;
use App\Models\Championship;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class ChampionshipController extends Controller
{
    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        $users = User::orderBy('name')->get();
        $channels = Channel::orderBy('name')->get();

        return view('admin.championships.create', [
            'users' => $users,
            'channels' => $channels
        ]);
    }

    /**
     * @param CreateChampionshipRequest $request
     * @return RedirectResponse
     */
    public function store(CreateChampionshipRequest $request): RedirectResponse
    {
        $championship = Championship::create([
            'name' => $request->get('name')
        ]);

        $user = User::find($request->get('user_id'));
        $channel = Channel::find($request->get('channel_id'));

        $championship->user()->associate($user);
        $championship->channel()->associate($channel);

        $championship->save();

        return redirect(route('admin.championships'))->with('notice', "Championship with name '{$request->get('name')}' created");
    }
}
