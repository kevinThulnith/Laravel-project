<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // TODO: Display the login view.
    public function create(): View
    {
        return view('auth.login');
    }

    // TODO: Handle an incoming authentication request.
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate the session ID to prevent fixation attacks
        $request->session()->regenerate();

        // Create a new token for the authenticated user
        $user = Auth::user();
        $token = $user->createToken($user->name);

        // Save the token in the session
        $request->session()->put('auth_token', $token->plainTextToken);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    // TODO: Destroy an authenticated session.
    public function destroy(Request $request): RedirectResponse
    {
        // !Delete all user tokens
        $request->user()->tokens()->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
