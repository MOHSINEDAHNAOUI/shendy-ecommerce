<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (auth()->user() && auth()->user()->role === 'admin') {
            return '/admin';
        }
        return '/';
    }

    public function __construct()
    {
        // Middleware removed temporarily
    }
}