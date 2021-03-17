<?php

namespace App\Services;

use App\Exceptions\InvalidChannelRequestException;
use App\Exceptions\InvalidUserRequestException;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use stdClass;

class DiscordService
{
    /**
     * @param SocialiteUser $discordUser
     * @param bool $isAdmin
     * @return User
     */
    public function upsertUser(SocialiteUser $discordUser, bool $isAdmin): User
    {
        $avatar = $this->getAvatar($discordUser);

        return User::updateOrCreate([
            'provider_id' => $discordUser->getId()
        ], [
            'name' => $discordUser->getName(),
            'email' => $discordUser->getEmail(),
            'avatar' => $avatar,
            'discriminator' => $discordUser->user['discriminator'],
            'token' => $discordUser->token,
            'refresh_token' => $discordUser->refreshToken,
            'expires_in' => $discordUser->expiresIn,
            'is_admin' => $isAdmin
        ]);
    }

    /**
     * @param array $roles
     * @return bool
     */
    public function isAdmin(array $roles): bool
    {
        return in_array(config('discord.admin_role_id'), $roles);
    }

    /**
     * @param string $id
     * @return stdClass
     */
    public function getDiscordUser(string $id): stdClass
    {
        $response = $this->makeRequest("members/{$id}");

        if ($response['status'] !== 200) {
            (new InvalidUserRequestException)->render($response['status']);
        }

        return $response['body'];
    }

    /**
     * @param string $id
     * @return array
     */
    public function getDiscordChannel(string $id): array
    {
        $baseUrl = config('discord.api_base_url');

        $response = Http::withToken(config('discord.bot_token'), 'Bot')->get($baseUrl . "/channels/{$id}");
        $status = $response->status();

        if ($response->status() !== 200) {
            (new InvalidChannelRequestException)->render($status);
        }

        return json_decode($response->body(), true);
//        $response = $this->makeRequest("channels");
//
//        if ($response['status'] !== 200) {
//            die();
//        }
//
//        $channels = $response['body'];
//
//        foreach ($channels as $channel) {
//            dd($channel);
//        }
    }

    /**
     * @param string $url
     * @return array
     */
    private function makeRequest(string $url): array
    {
        $baseUrl = config('discord.api_base_url');
        $simLairId = config('discord.sim_lair_id');
        $url = $baseUrl . "/guilds/{$simLairId}/" . $url;

        $response = Http::withToken(config('discord.bot_token'), 'Bot')->get($url);

        return [
            'status' => $response->status(),
            'body' => json_decode($response->body())
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