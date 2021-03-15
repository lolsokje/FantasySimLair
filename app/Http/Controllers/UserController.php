<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidDiscordUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Services\DiscordService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.users.create');
    }

    /**
     * @param CreateUserRequest $request
     * @param DiscordService $discordService
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request, DiscordService $discordService): RedirectResponse
    {
        $providerId = $request->get('user_id');
        $response = $discordService->getDiscordUserDetails($providerId);

        if (!$response['success']) {
            return (new InvalidDiscordUserRequest())->render($response['code']);
        }

        $user = User::create([
            'provider_id' => $providerId,
            'name' => $response['name']
        ]);

        return redirect(route('admin.users'))->with('notice', "User with username {$user->name} has been created");
    }
}
