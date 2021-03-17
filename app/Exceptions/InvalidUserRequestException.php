<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;

class InvalidUserRequestException extends Exception
{
    private const RESPONSES = [
        400 => "The provided user ID is invalid",
        404 => "A user with the provided ID doesn't exist in the Sim Lair server",
    ];

    /**
     * @param int $code
     * @return RedirectResponse
     */
    public function render(int $code): RedirectResponse
    {
        $route = auth()->check() && auth()->user()->is_admin ? route('admin.users.create') : route('index');
        $error = self::RESPONSES[$code];
        throw new HttpResponseException(redirect($route)->with('error', $error));
    }
}
