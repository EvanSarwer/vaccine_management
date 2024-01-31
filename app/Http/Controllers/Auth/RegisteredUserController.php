<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'min:4', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'nid' => [
                'required',
                'string',
                'min:6',
                'max:15',
                Rule::unique('users', 'nid')->where(function ($query) {
                    return $query->where('role', 'user');
                }),
            ],
            'password' => ['required', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised(), 'confirmed', Rules\Password::defaults()],
            'dob' => ['required','date'],
            'phone' => ['required', 'string', 'min:10'],
            'address' => ['required', 'string'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'nid' => $request->nid,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
