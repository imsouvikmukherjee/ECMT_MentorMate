<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

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

        $request->session()->put('usertype', $request->user()->usertype);

        $request->session()->put('userid', $request->user()->id);
        $request->session()->put('name', $request->user()->name);
        $request->session()->put('email', $request->user()->email);
        $request->session()->put('contact', $request->user()->contact);

        // Set login success flag for welcome message
        $request->session()->put('login_success', true);

        if($request->user()->usertype === 'Student'){
            // Get student details for the current user
            $student = DB::table('student_details')
                ->where('user_id', $request->user()->id)
                ->first();

            // Store profile picture information in session if it exists
            if ($student && isset($student->profile_picture)) {
                $request->session()->put('profile_picture', $student->profile_picture);
            } else {
                // Store a placeholder value to prevent undefined property error
                $request->session()->put('profile_picture', null);
            }

            return redirect()->intended(route('user.dashboard', absolute: false));
        } elseif($request->user()->usertype === 'Admin'){
            return redirect()->intended(route('admin_dashboard', absolute: false));

        } elseif($request->user()->usertype === 'Mentor'){
            return redirect()->intended(route('admin_dashboard', absolute: false));

        } elseif($request->user()->usertype === 'Superadmin'){
            return redirect()->intended(route('admin_dashboard', absolute: false));

        } else{
            return redirect()->back();
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

        $request->session()->forget('usertype');

        $request->session()->forget('name');
        $request->session()->forget('email');
        $request->session()->forget('contact');
        $request->session()->forget('profile_picture');

        return redirect()->route('login');
    }
}
