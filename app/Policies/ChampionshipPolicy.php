<?php

namespace App\Policies;

use App\Models\Championship;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChampionshipPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * @param User $user
     * @param Championship $championship
     * @return bool
     */
    public function createSeason(User $user, Championship $championship): bool
    {
        return $user->id === $championship->user_id;
    }
}
