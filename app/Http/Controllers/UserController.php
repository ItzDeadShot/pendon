<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin', ['only' => ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all()->except(Auth::id());
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required','confirmed', 'min:8'],
                'roles' => ['required', 'array'],
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            if (!$user) {
                return redirect()->back()->with('error','Something went wrong!');
            }

            // Attach roles to the user
            $user->syncRoles($request->input('roles'));

            return redirect()->route('users.index')->with('success','User has been created successfully.');
        } catch (\Exception $e) {
            Log::log('error',$e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): \Illuminate\Http\JsonResponse
    {
        try {
            // You can customize the data you want to return to the frontend
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
                'proof' => $user->proof,
            ];
            return response()->json($userData);

        } catch (\Exception $e) {
            // Handle the case where the user with the given ID is not found
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|\Illuminate\Contracts\Foundation\Application|View
     */
    public function edit(User $user): View|Factory|Application|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $user->fill($request->post())->save();

        return redirect()->route('users.index')->with('success','User Has Been updated successfully');
    }

    /**
     * Approve the specified resource in storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function approve(User $user): RedirectResponse
    {
        $user->update(['email_verified_at' => now()]);
        return redirect()->route('users.index')->with('success','User has been approved successfully');
    }

    /**
     * Reject the specified resource in storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function reject(User $user): RedirectResponse
    {
        try {
            $user->update(['email_verified_at' => null]);

            return redirect()->route('users.index')->with('success', 'User has been rejected successfully');
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error rejecting user: ' . $e->getMessage());

            // Redirect with an error message
            return redirect()->route('users.index')->with('error', 'Error rejecting user. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','User has been deleted successfully');
    }
}
