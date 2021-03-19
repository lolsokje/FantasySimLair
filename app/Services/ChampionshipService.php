<?php

namespace App\Services;

use App\Models\Championship;
use App\Models\Channel;
use App\Models\User;

class ChampionshipService
{
    public function createChampionship(User $user, Channel $channel, string $name): Championship
    {
        $championship = Championship::create([
            'name' => $name
        ]);


        $championship->user()->associate($user);
        $championship->channel()->associate($channel);

        $championship->save();

        return $championship;
    }
}