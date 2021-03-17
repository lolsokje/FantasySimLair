<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;

class AdminController extends Controller
{
    /**
     * @return Renderable
     */
    public function users(): Renderable
    {
        $users = User::orderBy('name')->get();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * @return Renderable
     */
    public function channels(): Renderable
    {
        $channels = Channel::orderBy('name')->get();

        return view('admin.channels.index', [
            'channels' => $channels
        ]);
    }

    /**
     * @return Renderable
     */
    public function championships(): Renderable
    {
        $championships = Championship::orderBy('name')->get();

        return view('admin.championships.index', [
            'championships' => $championships
        ]);
    }
}
