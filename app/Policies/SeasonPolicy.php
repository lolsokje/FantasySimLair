<?php

namespace App\Policies;

use App\Models\Season;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeasonPolicy
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
     * @param Season $season
     * @return bool
     */
    public function update(User $user, Season $season): bool
    {
        return $user->id === $season->championship->user_id;
    }
}
