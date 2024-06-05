<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $loginRequest): JsonResponse
    {
        $requestBody = $loginRequest->validated();

        $user = User::query()->where('username', $requestBody['username'])->first();
        if (!$user || !Hash::check($requestBody['password'], $user->password)) {
            return response()->json(['message' => 'invalid username or password'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'successfully logged in',
            'data' => [
                'token' => $token
            ]
        ], 200);
    }
}
