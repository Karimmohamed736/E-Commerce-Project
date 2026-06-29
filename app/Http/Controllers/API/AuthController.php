<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApI\LoginRequest;
use App\Http\Requests\ApI\RegisterRequest;
use App\Services\API\AuthService;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());

        return response()->json([
            'success'      => true,
            'msg'          => 'Register Successfully',
            'access_token' => $result['token'],
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        if (!$result) {
            return response()->json([
                'success' => false,
                'msg'     => 'Email or Password is Not Correct',
            ], 401);
        }

        return response()->json([
            'success'      => true,
            'access_token' => $result['token'],
        ], 200);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json([
            'success' => true,
            'msg'     => 'Logout Successfully',
        ], 200);
    }
}
