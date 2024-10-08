<?php

namespace App\Http\Middleware;

use App\Interfaces\IUserRepository;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function __construct(
        private IUserRepository $userRepository
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $token = trim(str_replace('Bearer ', '', $request->header('Authorization')));
        $user = $this->userRepository->findByToken($token);
        if ($user === null) {
            abort(403);
        }

        auth()->login($user);

        return $next($request);
    }
}
