<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ClosedCash;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function index()
    {
        // login view
        return view('pages.auth-signin');
    }

    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        // login process
        $request->authenticate();

        $request->session()->regenerate();

        // check and add session closed cash
        $idUser = Auth::id();
        $request->session()->put('ClosedCash', $this->ClosedCash($idUser));

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        //logout process
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function create()
    {
        // register view
        return view('pages.auth-signup');
    }

    public function store(Request $request)
    {
        // store regtister and signin automatically after that
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'role' => 'Umum',
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // check and add session closed cash
        $idUser = Auth::id();
        $request->session()->put('ClosedCash', $this->ClosedCash($idUser));

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Handle Closed Cashed after login to session
     * @param number ID USER
     * @return string Active Closed id
     */
    public function ClosedCash($idUser)
    {
        $data = ClosedCash::whereNull('closed')->latest()->first();
        if ($data) {
            // jika null maka buat data
            return $data->active;
        }
        $generateClosedCash = md5(now());
        $isi = [
            'active' => $generateClosedCash,
            'user_id' => $idUser,
        ];
        $createData = ClosedCash::create($isi);
        return $generateClosedCash;

    }
}
