<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function store()
    {
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]
        );
         User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]
        );
        return redirect()->route('dashboard')->with('success', 'Account created succesfully!');
    }
}
