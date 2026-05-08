<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $user->update($request->only('name', 'email'));
        return redirect('/users')->with('success', 'Utilisateur mis à jour !');
    }

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect('/users')->with('success', 'Utilisateur supprimé !');
    }
}
