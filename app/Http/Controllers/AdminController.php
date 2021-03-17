<?php

namespace App\Http\Controllers;

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
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * @return Renderable
     */
    public function channels(): Renderable
    {
        $channels = Channel::all();

        return view('admin.channels.index', [
            'channels' => $channels
        ]);
    }

    /**
     * @return Renderable
     */
    public function championships(): Renderable
    {
        return view('admin.championships');
    }
}
