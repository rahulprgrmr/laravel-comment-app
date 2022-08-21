<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:admins',
            'password' => 'required'
        ], [
            'email.exists' => 'Admin with the provided email id doesnt exists'
        ]);

        $email = $request->post('email');
        $password = $request->post('password');

        $admin = Admin::where('email', $email)->first();

        if (!$admin)
        {
            return redirect('/admin/login')->withErrors('Admin with the provided email id doesnt exists');
        }

        if (!Hash::check($password, $admin->password))
        {
            return redirect('/admin/login')->withErrors('Invalid credentials');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/comments');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');


    }

    public function comments()
    {
        $admin = Auth::user();
        if (!$admin || $admin->getTable() != 'admins')
        {
            return redirect('/login');
        }
        $comments = $admin->comments;
        return view('admin.comments', compact('comments'));
    }

    public function create_comments()
    {
        $admin = Auth::user();
        if (!$admin || $admin->getTable() != 'admins')
        {
            return redirect('/login');
        }
        return view('admin.add_comment');
    }

    public function store_comments(Request $request)
    {
        $admin = Auth::user();
        if (!$admin || $admin->getTable() != 'admins')
        {
            return redirect('/login');
        }
        $request->validate([
            'body' => 'required'
        ]);

        $body = $request->post('body');

        $admin->comments()->create([
            'body' => $body
        ]);

        return redirect('/admin/comments')->with([
            'success_message' => "Comment created successfully"
        ]);
    }
}
