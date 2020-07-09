<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Сервис аутентификации
 */
class AuthService
{
    /**
     * Проверить аутентификацию из заголовка
     *
     * @param Request $request
     *
     * @return bool
     */
    public function check(Request $request): bool
    {
        $header = $request->header('Authorization');
        if (null === $header) {
            return false;
        }

        if (Str::startsWith($header, 'Bearer ')) {
            $token = Str::substr($header, 7);

            return $token === config('auth.token');
        }

        return false;
    }
}
