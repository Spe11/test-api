<?php

namespace App\Models\json;

use Illuminate\Http\JsonResponse;

/**
 * Модель ответа ошибки
 */
class JsonErrorResponse
{
    /** @var string $status Статус */
    private static $status = 'error';

    /**
     * Не найдено
     *
     * @return JsonResponse
     */
    public static function notFound(): JsonResponse
    {
        return new JsonResponse([
            'status'  => static::$status,
            'message' => 'Not found',
        ], 404);
    }

    /**
     * Не авторизован
     *
     * @return JsonResponse
     */
    public static function forbidden(): JsonResponse
    {
        return new JsonResponse([
            'status'  => static::$status,
            'message' => 'Authentication failed',
        ], 401);
    }

    /**
     * Метод запрещен
     *
     * @return JsonResponse
     */
    public static function notAllowed(): JsonResponse
    {
        return new JsonResponse([
            'status'  => static::$status,
            'message' => 'Method not allowed',
        ], 405);
    }

    /**
     * Ошибка сервера
     *
     * @return JsonResponse
     */
    public static function serverError(): JsonResponse
    {
        return new JsonResponse([
            'status'  => static::$status,
            'message' => 'Server error',
        ], 500);
    }
}