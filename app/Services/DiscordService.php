<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class DiscordService
{
    /**
     * @param SocialiteUser $discordUser
     * @return User
     */
    public function upsertUser(SocialiteUser $discordUser): User
    {
        $user = User::updateOrCreate([
            'provider_id' => $discordUser->getId()
        ], [
            'name' => $discordUser->getName(),
            'email' => $discordUser->getEmail(),
            'avatar' => $discordUser->getAvatar(),
            'discriminator' => $discordUser->user['discriminator'],
            'token' => $discordUser->token,
            'refresh_token' => $discordUser->refreshToken,
            'expires_in' => $discordUser->expiresIn
        ]);

        $userDetails = $this->getUserDetails($user);

        $user->is_member = $userDetails['is_member'];
        $user->is_admin = $userDetails['is_admin'];
        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getUserDetails(User $user): array
    {
        $ret = [
            'is_member' => false,
            'is_admin' => false
        ];

        $baseUrl = config('discord.api_base_url');
        $simLairId = config('discord.sim_lair_id');
        $url = $baseUrl . "/guilds/{$simLairId}/members/{$user->provider_id}";

        $response = Http::withToken(config('discord.bot_token'), 'Bot')->get($url);
        $body = json_decode($response->body());

        $isMember = $response->status() === 200;

        $ret['is_member'] = $isMember;
        $ret['is_admin'] = $isMember && in_array(config('discord.admin_role_id'), $body->roles);

        return $ret;
    }
}