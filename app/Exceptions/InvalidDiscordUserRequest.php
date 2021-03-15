<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class InvalidDiscordUserRequest extends Exception
{
    private const RESPONSES = [
        400 => "The provided user ID is invalid",
        404 => "A user with the provided ID doesn't exist",
    ];

    /**
     * @param int $code
     * @return RedirectResponse
     */
    public function render(int $code): RedirectResponse
    {
        return redirect()->back()->withErrors(['error' => self::RESPONSES[$code]]);
    }
}
