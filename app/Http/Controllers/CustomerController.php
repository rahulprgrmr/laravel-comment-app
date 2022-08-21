<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:customers',
            'password' => 'required'
        ], [
            'email.exists' => 'Customer with the provided email id doesnt exists'
        ]);

        $email = $request->post('email');
        $password = $request->post('password');

        $user = Customer::where('email', $email)->first();

        if (!$user)
        {
            return redirect('/login')->withErrors('Customer with the provided email id doesnt exists');
        }

        if (!Hash::check($password, $user->password))
        {
            return redirect('/login')->withErrors('Invalid credentials');
        }

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('comments');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');


    }

    public function comments()
    {
        $user = Auth::guard('customer')->user();
        if (!$user || $user->getTable() != 'customers')
        {
            return redirect('/login');
        }
        $comments = $user->comments;
        return view('comments', compact('user', 'comments'));
    }

    public function create_comments()
    {
        $user = Auth::guard('customer')->user();
        if (!$user || $user->getTable() != 'customers')
        {
            return redirect('/login');
        }
        return view('add_comment');
    }

    public function store_comments(Request $request)
    {
        $user = Auth::guard('customer')->user();
        if (!$user || $user->getTable() != 'customers')
        {
            return redirect('/login');
        }
        $request->validate([
            'body' => 'required'
        ]);

        $body = $request->post('body');

        $user->comments()->create([
            'body' => $body
        ]);

        return redirect('/comments')->with([
            'success_message' => "Comment created successfully"
        ]);
    }
}
