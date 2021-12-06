<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        $validated = $request->validated();

        $user = $request->searchForAUserByEmailOrUsername($validated['login_field']);

        if (
            !$request->verifyUserRole($user, 'prisoner')
            && $request->verifyUserState($user)
            && $request->verifyUserPassword($user, $validated['password'])
        ) {
            $token = $user->createToken('token-name')->plainTextToken;

            return response([
                'user' => new UserResource($user),
                'token' => $token
            ], 201);
        }

        return response([
            'message' => __('auth.failed'),
        ], 401);
    }

    public function logout(Request $request): array
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
