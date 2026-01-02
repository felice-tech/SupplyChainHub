<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $record = User::query();

        $users = $record->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $base = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin',
        ]);

        if (!empty($base['password'])){
            $base['password'] = bcrypt($base['password']);
        }

        User::create([
            'name' => $base['name'],
            'email' => $base['email'],
            'password' => $base['password'],
            'role' => $base['role'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('user-management.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user_management)
    {
        return view('user.view', ['item' => $user_management]);
    }

    public function edit($id)
    {
        $item = User::findOrFail($id);
        return view('user.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // Don't update password if not provided
        }

        $data['updated_at'] = now();

        $user->update($data);

        return redirect()->route('user-management.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()
            ->route('user-management.index')
            ->with('success', 'User deleted successfully.');
    }
    
}
