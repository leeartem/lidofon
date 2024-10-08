<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ResetPasswordTokenRequest;
use App\Http\Resources\UserTokenResource;
use App\Repositories\UserRepository;
use App\Services\User\ResetUserPasswordService;
use App\Services\User\SetNewPasswordService;
use App\Services\User\StoreUserService;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function register(RegisterRequest $request, StoreUserService $service)
    {
        $user = $service->run($request->validated());

        return new UserTokenResource($user);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->findByEmail($request->get('email'));

        if (! Hash::check($request->password, $user->password)) {
            abort(403);
        }

        return new UserTokenResource($user);
    }

    public function resetPassword(ResetPasswordRequest $request, ResetUserPasswordService $service)
    {
        $service->run($request->get('email'));

        return response()->json([
            'status' => 'Ok',
        ]);
    }

    public function resetPasswordToken(ResetPasswordTokenRequest $request, SetNewPasswordService $service)
    {
        $user = $service->run($request->validated());

        return new UserTokenResource($user);
    }
}
