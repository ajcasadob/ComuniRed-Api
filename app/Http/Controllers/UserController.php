<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        return User::with('vivienda')->get();
    }

    public function show(User $usuario)
    {
        return response()->json($usuario->load('vivienda'), 200);
    }

   public function update(Request $request, User $usuario)
{
    $request->validate([
        'name'             => ['sometimes', 'string', 'max:255'],
        'email'            => ['sometimes', 'email', 'max:255', 'unique:users,email,' . $usuario->id],
        'role'             => ['sometimes', 'string', 'in:admin,user,guest'],
        'vivienda_id'      => ['nullable', 'exists:viviendas,id'],
        'current_password' => ['required_with:password', 'current_password'],
        'password'         => ['sometimes', 'confirmed', Password::defaults()],
    ]);

    $data = $request->except(['password', 'current_password', 'password_confirmation']);

    if ($request->has('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $usuario->update($data);
    $usuario->refresh();

    return response()->json($usuario->load('vivienda'), 200);
}


    public function asignarVivienda(Request $request, User $usuario)
    {
        $request->validate([
            'vivienda_id' => ['required', 'exists:viviendas,id'],
        ]);

        $usuario->vivienda_id = $request->vivienda_id;
        $usuario->save();

        return response()->json($usuario->load('vivienda'), 200);
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
