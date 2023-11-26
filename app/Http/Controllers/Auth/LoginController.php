<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function auntificate(Request $request): RedirectResponse
    {
        $validator = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if (auth('web')->attempt($validator)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Не правильное имя пользователя или пароль'
        ])->onlyInput('email');
    }
}
