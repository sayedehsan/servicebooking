<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
       $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $loginData = $validator->validated();
        $login = $loginData['email'];
        // Check if the login is a mobile number or email
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            // It's an email
            $user = User::where('email', $login)->first();
            $password = $loginData['password'];
            if (!$user || !Hash::check($password, $user->password)) {
                  return response()->json([
                    'code'  => 401,
                    'message' => 'Invalid credentials',
                ], 401);
            }
            // Generate a token for the user // createToken('auth_token') is used to create a token for the user
            $token = $user->createToken($login)->plainTextToken;
             return response()->json([
                    'code'  => 201,
                    'token' => $token,
                    'message' => 'User logged in successfully.',
                ], 201);
              
        }
         return response()->json([
                    'code'  => 400,
                    'message' => 'Invalid login email format!',
                ], 400);
    }

    public function register(Request $request) : JsonResponse
    {
          $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)]),
            ['user_type' => "user"]
        );
        // Generate a token for the user
        $token = $user->createToken($user['email'])->plainTextToken;
        return response()->json([
                'code'  => 201,
                'token' => $token,
                'message' => 'Registration Successfull.',
            ], 201);
    }

    public function profile() : JsonResponse
    {
        return response()->json([
            'code' => 200,
            'data' => Auth::user(),
        ], 200);
    }

    public function logout(Request $request) : JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        // Auth::logout();
        return response()->json([
                'code'  => 201,
                'message' => 'Logged Out.',
            ], 201);
    }
}
