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

class UserController extends Controller
{
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

//        if (!$user) {
//            return redirect()->back()->with('error','Something went wrong!');
//        }

        // Attach roles to the user
        $user->syncRoles($request->input('roles'));

        return redirect()->route('users.index')->with('success','User has been created successfully.');
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