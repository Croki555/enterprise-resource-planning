<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function index():View
    {
        return view('auth.register');
    }

    public function store(Request $request):RedirectResponse
    {
        $validator = $request->validate([
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'unique:' . User::class],
            'password'=> ['required', 'string', 'confirmed']
        ]);

        $user = new User();
        $user->name = $validator['name'];
        $user->email = $validator['email'];
        $user->password = Hash::make($validator['password']);
        $user->saveOrFail();

        event(new Registered($user));

        $request->session()->regenerate();
        $request->session()->regenerateToken();

        auth('web')->login($user);

        return redirect()->route('home');
    }
}
