<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            dd($user);
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
    public function register(Request $request){
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make($request->password)
        ]);

        $token = null;
        $token = $user->createToken('ADMIN-TOKEN', ['select', 'create', 'update', 'delete']);
        return response()->json(['success' =>true, 'data' => $user,'token' => $token->plainTextToken],201);
    }
}
