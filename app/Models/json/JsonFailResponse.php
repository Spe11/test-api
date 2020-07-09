<?php

namespace App\Models\json;

use Illuminate\Http\JsonResponse;

/**
 * Модель ответа неудачи
 */
class JsonFailResponse
{
    /** @var string $status Статус */
    private static $status = 'fail';

    /**
     * Ошибка валидации
     *
     * @param array $errors
     *
     * @return JsonResponse
     */
    public static function validationError(array $errors): JsonResponse
    {
        return new JsonResponse([
            'status' => static::$status,
            'data'   => $errors,
        ], 422);
    }
}