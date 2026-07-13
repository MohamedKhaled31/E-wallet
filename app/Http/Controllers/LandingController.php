<?php

namespace App\Http\Controllers;


class LandingController extends Controller
{
    public function home(){
        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('wallet.index');
            }
        }
        return view('landing.home');
    }
}
