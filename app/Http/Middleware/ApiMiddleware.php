<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ApiMiddleware
{
    protected $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        if (false === $this->auth->check($request)) {
            throw new UnauthorizedHttpException('Bearer');
        }

        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}