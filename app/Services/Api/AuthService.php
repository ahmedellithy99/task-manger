<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return [
            'user' => $user,
            'access_token' => $token,
        ];
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return [
                'error' => 'Invalid credentials',
                'status' => Response::HTTP_UNAUTHORIZED,
            ];
        }

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return [
            'user' => $user,
            'access_token' => $token,
        ];
    }

    public function logout(User $user)
    {
        $user->tokens()->delete();

        return ['message' => 'Successfully logged out'];
    }
}
