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
use Illuminate\View\View;

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
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ]);

            // Handle file upload
            $imagePath = $request->file('image')->store('images', 'public');

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'proof' => $imagePath,
            ]);

            $user->assignRole('donee', 'donor');

            event(new Registered($user));

            Auth::login($user);

            if ($user->isDonee()) {
                return redirect()->route('/')->with('success', 'Your account has been created. Please contact an admin to verify your account.');
            }

            return redirect(RouteServiceProvider::HOME);
        } catch (ValidationException $e) {
            // Validation failed
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error creating user: ' . $e->getMessage());

            // Redirect with an error message
            return redirect()->route('register')->with('error', 'Error creating user. Please try again.');
        }
    }
}
