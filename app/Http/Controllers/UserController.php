<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::with('vivienda')->get();
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return response()->json($user->load('vivienda'), 200);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['sometimes', 'string', 'in:admin,user,guest'],
            'vivienda_id' => ['nullable', 'exists:viviendas,id'],
            'password' => ['sometimes', 'confirmed', Password::defaults()],
        ]);

        $data = $request->except('password');
        
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        
        // Recargar el modelo desde la base de datos
        $user->refresh();
        
        return response()->json($user->load('vivienda'), 200);
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

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
