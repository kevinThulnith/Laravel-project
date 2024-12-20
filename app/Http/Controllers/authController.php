<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class authController extends Controller
{
    // TODO: register new user
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = User::create($data);
        event(new Registered($user));
        Auth::login($user);
        // !Create new token on register
        $token = $user->createToken($request->name);
        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    // TODO: login user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return ['message' => 'The provided credentials are incorrect'];
        }
        // !Create new token on ogin
        $token = $user->createToken($user->name);
        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    // TODO: logout user
    public function logout(Request $request)
    {
        // !Delete all user tokens
        $request->user()->tokens()->delete();
        return ['message' => 'You are logged out'];
    }
}
