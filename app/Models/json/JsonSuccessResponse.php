<?php

namespace App\Models\json;

use Illuminate\Http\JsonResponse;

/**
 * Модель успешного ответа
 */
class JsonSuccessResponse
{
    /** @var string $status Статус */
    private static $status = 'success';

    /**
     * Не найдено
     *
     * @return JsonResponse
     */
    public static function success(): JsonResponse
    {
        return new JsonResponse([
            'status' => static::$status,
            'data'   => null,
        ]);
    }
}