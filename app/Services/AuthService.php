<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($request): JsonResponse
    {
        try {
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            $user->tokens()->where('name', "TOKEN")->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout($request): JsonResponse
    {
        $user = User::where('email', auth()->user()->email)->first();
        $user->tokens()->where('name', "TOKEN")->delete();

        return response()->json([
            "status" =>true,
            "message" => "Successfully Logged out."
        ]);
    }
}