<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;

class InvalidChannelRequestException extends Exception
{
    private const RESPONSES = [
        403 => "The provided channel doesn't exist in this server",
        404 => "A channel with the provided ID doesn't exist",
    ];

    /**
     * @param int $code
     * @return RedirectResponse
     */
    public function render(int $code): RedirectResponse
    {
        $error = self::RESPONSES[$code];
        throw new HttpResponseException(redirect(route('admin.channels.create'))->with('error', $error));
    }
}
