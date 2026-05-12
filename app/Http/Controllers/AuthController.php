<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:8",
        ]);

        $user = User::where("email", $request->email)->first();
        // Cek user
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(
                [
                    "message" => "Invalid credentials",
                ],
                401,
            );
        }
        // generate token
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => "Logged in successfuly",
            "user" => $user,
            "token" => $token,
        ]);
    }

    // Register
    public function register(Request $request)
    {
        $request->validate([
            "username" => "required|min:6|max:14|unique:users,username",
            "name" => "required|min:3|max:32",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
        ]);
        $hashPassword = Hash::make($request->password);
        $user = User::create([
            "username" => $request->username,
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hashPassword,
        ]);

        return response()->json([
            "message" => "Register successfuly",
            "user" => $user,
        ]);
    }

    // Me
    public function me(Request $request)
    {
        $user = Auth::user();
        $posts = Posts::with("category")->where("user_id", $user->id)->get();
        return response()->json([
            "user" => $user->makeHidden(["created_at", "updated_at"]),
            "posts" => $posts,
        ]);
    }

    // Logout
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "message" => "Logged Out",
        ]);
    }
}
