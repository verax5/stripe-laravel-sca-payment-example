<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        if(auth()->check()) {
            return redirect()->to('products');
        }

        return view('login');
    }

    public function check(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('checkout');
        }

        return 'Login failed';
    }

    public function logout() {
        auth()->logout();
        return 'Logged out';
    }
}
