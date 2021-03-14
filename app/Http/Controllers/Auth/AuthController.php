<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\DiscordService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('discord')
            ->scopes(['guilds'])
            ->redirect();
    }

    /**
     * @param Request $request
     * @param DiscordService $discordService
     * @return RedirectResponse
     * @throws Exception
     */
    public function handleProviderCallback(Request $request, DiscordService $discordService): RedirectResponse
    {
        if ($request->has('error')) {
            return redirect(route('index'))
                ->with('error', 'Something went wrong during authentication, please try again');
        }

        $discordUser = Socialite::driver('discord')->user();

        $user = $discordService->upsertUser($discordUser);

        auth()->login($user, true);

        return redirect(route('index'))
            ->with('notice', "Welcome {$user->name}");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('index'));
    }
}