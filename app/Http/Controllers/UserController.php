<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function getRegistrateForm()
    {
        return view('registrateForm');
    }

    public function registrate(RegistrateRequest $request)
    {
        $user = User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        return redirect(route('login'));
    }

    public function getLoginForm()
    {
        return view('loginForm');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect()->route('profile');
        }

        return back()->withErrors([
            'email' => 'Неверные данные для входа',
        ])->onlyInput('email');
    }

    public function getProfile()
    {
        $user = Auth::user();

        return view('profilePage', ['user' => $user]);
    }

    public function getEditProfileForm()
    {
        $user = Auth::user();
        return view('editProfileForm', ['user' => $user]);
    }

    public function editProfile(EditProfileRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');


        $user->save();
        return redirect()->route('profile');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
