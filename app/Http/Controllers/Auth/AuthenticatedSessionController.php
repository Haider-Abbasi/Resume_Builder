<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
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
    {
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);

        // Get the authenticated user
        $user = $request->user();



        // Save user ID in session
        if ($user) {
            Session::put('user_id', $user->id);
        }


        // Check the user_type
        if ($user && $user->user_type === 'admin') {
            // Redirect admin to admin dashboard
            return redirect()->route('admindashboard');
        } elseif ($user && $user->user_type === 'user') {
            // Redirect user to user dashboard
            return redirect()->route('dashboard');
        } else {
            // Handle other user types or scenarios
            return redirect()->route('otherdashboard');
        }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
