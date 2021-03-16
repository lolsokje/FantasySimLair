<?php

namespace App\Services;

use App\Exceptions\InvalidDiscordUserRequest;
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
     * @param string|null $exceptionRoute
     * @return stdClass
     */
    public function getDiscordUser(string $id, ?string $exceptionRoute = 'index'): stdClass
    {
        $baseUrl = config('discord.api_base_url');
        $simLairId = config('discord.sim_lair_id');
        $url = $baseUrl . "/guilds/{$simLairId}/members/{$id}";

        $response = Http::withToken(config('discord.bot_token'), 'Bot')->get($url);
        $status = $response->status();

        if ($status !== 200) {
            (new InvalidDiscordUserRequest)->render($status, $exceptionRoute);
        }

        return json_decode($response->body());
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