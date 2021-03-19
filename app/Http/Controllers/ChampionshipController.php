<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChampionshipRequest;
use App\Http\Requests\UpdateChampionshipRequest;
use App\Models\Championship;
use App\Models\Channel;
use App\Models\User;
use App\Services\ChampionshipService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class ChampionshipController extends Controller
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $championships = auth()->user()->championships;
        return view('championships.index', [
            'championships' => $championships
        ]);
    }

    /**
     * @param Championship $championship
     * @return Renderable
     */
    public function show(Championship $championship): Renderable
    {
        return view('championships.show', [
            'championship' => $championship
        ]);
    }

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
     * @param Championship $championship
     * @return Renderable
     */
    public function edit(Championship $championship): Renderable
    {
        $users = User::orderBy('name')->get();
        $channels = Channel::orderBy('name')->get();

        $view = auth()->user()->is_admin ? view('admin.championships.edit') : view('championships.edit');

        return $view->with([
            'championship' => $championship,
            'users' => $users,
            'channels' => $channels
        ]);
    }

    /**
     * @param CreateChampionshipRequest $request
     * @return RedirectResponse
     */
    public function store(CreateChampionshipRequest $request, ChampionshipService $championshipService): RedirectResponse
    {
        $user = User::find($request->get('user_id'));
        $channel = Channel::find($request->get('channel_id'));

        $championshipService->createChampionship($user, $channel, $request->get('name'));

        return redirect(route('admin.championships'))->with('notice', "Championship with name '{$request->get('name')}' created");
    }

    /**
     * @param Championship $championship
     * @param UpdateChampionshipRequest $request
     * @return RedirectResponse
     */
    public function update(Championship $championship, UpdateChampionshipRequest $request): RedirectResponse
    {
        $isAdmin = auth()->user()->is_admin;
        if ($isAdmin) {
            $championship->user()->disassociate();
            $championship->channel()->disassociate();

            $user = User::find($request->get('user_id'));
            $channel = Channel::find($request->get('channel_id'));

            $championship->user()->associate($user);
            $championship->channel()->associate($channel);
        }

        $championship->name = $request->get('name');

        $championship->save();

        $route = $isAdmin ? route('admin.championships') : route('championships.index');

        return redirect($route)->with('notice', 'Championship updated');
    }
}
