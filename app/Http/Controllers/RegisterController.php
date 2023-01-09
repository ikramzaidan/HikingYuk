<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|min:4|max:255',
            'email' => 'required|email:dns|unique:users|max:255',
            'password' => 'required|max:255'
        ]);

        $validated['password'] = password_hash($validated['password'], PASSWORD_DEFAULT);

        if(User::create($validated)){
            $request->session()->flash('status', 'User was succesfully registered');
            return redirect('/login');
        }
    }
}
