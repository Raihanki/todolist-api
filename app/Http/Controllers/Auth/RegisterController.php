<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $registerRequest): JsonResponse
    {
        $requestBody = $registerRequest->validated();

        $user = User::query()->create([
            'username' => $requestBody['username'],
            'password' => Hash::make($requestBody['password']),
            'email' => $requestBody['email']
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'successfully registered',
            'data' => [
                'token' => $token
            ]
        ], 201);
    }
}
