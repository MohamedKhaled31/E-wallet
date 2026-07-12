<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = DB::transaction(function () use ($request) {

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => Hash::make($request->password),
                'role'     => 'user',
                'status'   => 'active',
            ]);

            Wallet::create([
                'user_id'  => $user->id,
                'balance'  => 0.00,
                'currency' => 'EGP',
                'status'   => 'active',
            ]);

            return $user;
        });

        Auth::login($user);

        return redirect()->route('wallet.index')->with('success', 'Account and wallet created successfully.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->wallet && $user->wallet->status === 'frozen') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your wallet has been frozen by admin.']);
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('wallet.index');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
