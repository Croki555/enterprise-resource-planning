<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IsAdmin extends Controller
{
    public static function isAdmin(): bool
    {
        return config('products.role') == 'admin';
    }
}
