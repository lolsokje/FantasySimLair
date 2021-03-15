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
        $avatar = $this->getAvatar($discordUser);

        $user = User::updateOrCreate([
            'provider_id' => $discordUser->getId()
        ], [
            'name' => $discordUser->getName(),
            'email' => $discordUser->getEmail(),
            'avatar' => $avatar,
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

    /**
     * @param string $id
     * @return array
     */
    public function getDiscordUserDetails(string $id): array
    {
        $baseUrl = config('discord.api_base_url');
        $simLairId = config('discord.sim_lair_id');
        $url = $baseUrl . "/guilds/{$simLairId}/members/{$id}";

        $response = Http::withToken(config('discord.bot_token'), 'Bot')->get($url);
        $status = $response->status();
        $body = json_decode($response->body());

        if ($status === 200) {
            return [
                'success' => true,
                'name' => $body->user->username
            ];
        }

        return [
            'success' => false,
            'code' => $status
        ];
    }

    /**
     * @param SocialiteUser $discordUser
     * @return string|null
     */
    private function getAvatar(SocialiteUser $discordUser): ?string
    {
        // getAvatar() will always return a string, even if no avatar exists. The user array contains null if no avatar
        // is set by the user, so that value is checked before assigning the variable.
        $userAvatar = $discordUser->user['avatar'];
        $avatar = $userAvatar ? $discordUser->getAvatar() : null;

        // if the avatar starts with 'a_', it's gif-compatible, so remove the extension and replace it with .gif
        if ($avatar && str_starts_with($userAvatar, 'a_')) {
            $avatar = substr($avatar, 0, -3);
            $avatar .= 'gif';
        }

        return $avatar;
    }
}