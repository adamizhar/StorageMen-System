<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // ⚠️ Only use this ONCE to assign initial role, then remove it!
        // Comment or delete after confirming it's applied.
        // $user = User::find(1);
        // $user?->assignRole('admin');

        $users = User::all(); // ✅ This loads all users
        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles($request->role); // ✅ Replace all old roles with new one

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Auto-create role if missing (optional)
        Role::firstOrCreate(['name' => $validated['role']]);

        $user->assignRole($validated['role']);

        return redirect()->route('users.index')->with('success', 'User created with role!');
    }
}
