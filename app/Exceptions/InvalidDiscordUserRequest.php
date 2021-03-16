<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;

class InvalidDiscordUserRequest extends Exception
{
    private const RESPONSES = [
        400 => "The provided user ID is invalid",
        404 => "A user with the provided ID doesn't exist in the Sim Lair server",
    ];

    /**
     * @param int $code
     * @param string $exceptionRoute
     * @return RedirectResponse
     */
    public function render(int $code, string $exceptionRoute): RedirectResponse
    {
        $error = self::RESPONSES[$code];
        throw new HttpResponseException(redirect(route($exceptionRoute))->with('error', $error));
    }
}
