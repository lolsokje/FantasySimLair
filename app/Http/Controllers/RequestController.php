<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequestRequest;
use App\Models\Channel;
use App\Models\ChampionshipRequest;
use App\Services\ChampionshipService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class RequestController extends Controller
{
    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        $channels = Channel::orderBy('name')->get();

        return view('requests.create', [
            'channels' => $channels
        ]);
    }

    /**
     * @param CreateRequestRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequestRequest $request): RedirectResponse
    {
        $championshipRequest = $request->user()->requests()->create([
            'name' => $request->get('name')
        ]);

        $channel = Channel::find($request->get('channel_id'));

        $championshipRequest->channel()->associate($channel);
        $championshipRequest->save();

        return redirect(route('index'))->with('notice', 'Championship request created');
    }

    /**
     * @param ChampionshipRequest $championshipRequest
     * @param ChampionshipService $championshipService
     * @return RedirectResponse
     * @throws Exception
     */
    public function approve(ChampionshipRequest $championshipRequest, ChampionshipService $championshipService): RedirectResponse
    {
        $user = $championshipRequest->user;
        $channel = $championshipRequest->channel;

        $championshipService->createChampionship($user, $channel, $championshipRequest->name);

        $championshipRequest->delete();

        return redirect(route('admin.requests'))->with('notice', 'Request approved, channel created');
    }

    /**
     * @param ChampionshipRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function reject(ChampionshipRequest $request): RedirectResponse
    {
        $request->delete();

        return redirect(route('admin.requests'))->with('notice', 'Request rejected');
    }
}
