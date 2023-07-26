<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
<<<<<<< HEAD
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
=======
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
>>>>>>> pemasok

class RegisteredUserController extends Controller
{
    /**
<<<<<<< HEAD
=======
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
>>>>>>> pemasok
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
<<<<<<< HEAD
    public function store(Request $request): Response
=======
    public function store(Request $request): RedirectResponse
>>>>>>> pemasok
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

<<<<<<< HEAD
        return response()->noContent();
=======
        return redirect(RouteServiceProvider::HOME);
>>>>>>> pemasok
    }
}
