<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
<<<<<<< HEAD
use Illuminate\Http\JsonResponse;
=======
>>>>>>> pemasok
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
<<<<<<< HEAD
    public function store(Request $request): JsonResponse|RedirectResponse
=======
    public function store(Request $request): RedirectResponse
>>>>>>> pemasok
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

<<<<<<< HEAD
        return response()->json(['status' => 'verification-link-sent']);
=======
        return back()->with('status', 'verification-link-sent');
>>>>>>> pemasok
    }
}
