<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
=======
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
>>>>>>> pemasok

class AuthenticatedSessionController extends Controller
{
    /**
<<<<<<< HEAD
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
=======
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
>>>>>>> pemasok
    {
        $request->authenticate();

        $request->session()->regenerate();

<<<<<<< HEAD
        return response()->noContent();
=======
        return redirect()->intended(RouteServiceProvider::HOME);
>>>>>>> pemasok
    }

    /**
     * Destroy an authenticated session.
     */
<<<<<<< HEAD
    public function destroy(Request $request): Response
=======
    public function destroy(Request $request): RedirectResponse
>>>>>>> pemasok
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

<<<<<<< HEAD
        return response()->noContent();
=======
        return redirect('/');
>>>>>>> pemasok
    }
}
