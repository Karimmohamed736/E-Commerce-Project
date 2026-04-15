<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //register
    public function register(Request $request)
    {
        //valid
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|min:8|confirmed|string'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()
            ], 422);
        }

        $password = bcrypt($request->password);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'email_verified at'=>now(),
        ]);

        $user->markEmailAsVerified();

        //create Token
        $access_token = $user->createToken('ApiToken')->plainTextToken;



        return response()->json([
            'success' => true,
            'msg' => 'Register successfully',
            'access_token' => $access_token
        ], 201);
    }

    //login
    public function login(LoginRequest $request)
    {
        $request->validated();


        //check
        $cred = $request->only('email', 'password');
        if (!Auth::attempt($cred)) {
            return response()->json([
                'success' => false,
                'msg' => 'Email or Password is Not Correct'
            ], 401);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        $access_token = $user->createToken('ApiToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'access_token' => $access_token
        ], 200);
    }


    //logout
    public function logout(Request $request){
    $request->user()->currentAccessToken()->delete();
    return response()->json([
        'success'=>true,
        'msg'=>'Logout Successfully'
    ],200);
    }
}
