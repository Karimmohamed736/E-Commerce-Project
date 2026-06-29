<?php

namespace App\Services\API;

use App\Jobs\SendWelocmeMailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data): array
    {
        $user = User::create($data);
        $user->markEmailAsVerified();

        $token = $user->createToken('ApiToken')->plainTextToken;

        dispatch(new SendWelocmeMailJob($user));
        // dd('job dispatched: '.$user->email);

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public function login(array $data): array|false
    {
        if (!Auth::attempt($data)) {
            return false;
        }

        $user = Auth::user();
        $user->tokens()->delete();

        $token = $user->createToken('ApiToken')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public function logout($user): void
    {
        $user->currentAccessToken()->delete();
    }
}
