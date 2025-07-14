<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Get all users

        return view('users.index', compact('users'));
    }
    public function updateRole(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|in:user,admin,manager,supervisor,staff',
    ]);

    $user->role = $request->role;
    $user->save();

    return redirect()->route('users.index')->with('success', 'Role updated successfully.');
}

}
