<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
 public function index()
    {
        // Solo los administradores pueden ver la lista de usuarios
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'No autorizado.'], 403);
        }

        $users = User::paginate(8);
        return response()->json($users);
    }

public function update(UpdateUserRequest $request, $id)
{
    $user = User::findOrFail($id);

    // Permitir si es el mismo usuario o si es admin
    if (Auth::id() !== $user->id && Auth::user()->role !== 'admin') {
        return response()->json(['error' => 'No autorizado.'], 403);
    }

    // Filtrar sólo los campos con valor no nulo ni vacío
    $filtered = array_filter($request->all(), function ($value) {
        return !is_null($value) && $value !== '';
    });

    $validated = $request->validate($request->rules(), [], $request->messages(), $filtered);

    if (isset($validated['name'])) {
        $user->name = $validated['name'];
    }
    if (isset($validated['email'])) {
        $user->email = $validated['email'];
    }
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return response()->json([
        'message' => 'User updated successfully.',
        'user' => $user,
    ]);
}

public function destroy($id)
{
    $user = User::findOrFail($id);

    // Permitir si es el mismo usuario o si es admin
    if (Auth::id() !== $user->id && Auth::user()->role !== 'admin') {
        return response()->json(['error' => 'No autorizado.'], 403);
    }

    $user->delete();

    return response()->json([
        'message' => 'User deleted successfully.',
    ]);
}

public function store(StoreUserRequest $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'No autorizado.'], 403);
        }

        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'user', 
        ]);

        return response()->json([
            'message' => 'User created successfully.',
            'user' => $user,
        ]);
    }   

 public function search(Request $request)
    {
        $query = $request->input('q');

        $users = User::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%")
              ->orWhere('id', $query);
        })->paginate(8);

        return response()->json($users);
    }

public function show($id)
{
    if (Auth::user()->role !== 'admin') {
        return response()->json(['error' => 'No autorizado.'], 403);
    }

    $user = User::findOrFail($id);

    return response()->json($user);
}
}