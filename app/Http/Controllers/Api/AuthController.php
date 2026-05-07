<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function getToken(Request $request)
    {
        try {
            // validasi email dan password
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // cek login
            if (!Auth::attempt($data)) {
                Log::info('[Auth - API] Email atau password salah');

                return response()->json([
                    'message' => 'Email atau password salah',
                ], 401);
            }

            // ambil user dari email
            $user = User::where('email', $request->email)->first();

            // buat token sanctum
            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'message' => 'Login berhasil',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat login', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat login',
            ], 500);
        }
    }
}