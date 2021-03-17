<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChannelRequest;
use App\Models\Channel;
use App\Services\DiscordService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class ChannelController extends Controller
{
    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.channels.create');
    }

    /**
     * @param CreateChannelRequest $request
     * @param DiscordService $discordService
     * @return RedirectResponse
     */
    public function store(CreateChannelRequest $request, DiscordService $discordService): RedirectResponse
    {
        $channelId = $request->get('channel_id');
        $discordChannel = $discordService->getDiscordChannel($channelId);

        Channel::updateOrCreate([
            'id' => $discordChannel['id']
        ], [
            'name' => $discordChannel['name']
        ]);

        return redirect(route('admin.channels'))->with('notice', "Channel with the name '{$discordChannel['name']} created or updated");
    }

    /**
     * @param Channel $channel
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Channel $channel): RedirectResponse
    {
        $channel->delete();

        return redirect(route('admin.channels'))->with('notice', "Channel has been removed");
    }
}
