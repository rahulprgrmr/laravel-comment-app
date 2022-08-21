<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function logout()
    {
        $user = Auth::user();

        if (!$user)
        {
            $user = Auth::guard('customer')->user();
        }

        $user_type = 'customer';

        if ($user->getTable() == 'admins')
        {
            $user_type = 'admin';
        }

        Auth::logout();

        if ($user_type == 'admin')
        {
            return redirect('/admin/login');
        }

        return redirect('/login');
    }
}
