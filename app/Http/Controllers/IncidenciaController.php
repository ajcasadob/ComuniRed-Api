<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    public function index()
    {
        return Incidencia::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'           => ['required', 'string', 'max:200'],
            'descripcion'      => ['required', 'string'],
            'ubicacion'        => ['required', 'string', 'max:255'],
            'categoria'        => ['required', 'string', 'max:50'],
            'prioridad'        => ['nullable', 'string', 'in:baja,media,alta'],
            'estado'           => ['required', 'string', 'max:50'],
            'usuario_id'       => ['required', 'integer', 'exists:users,id'],
            'vivienda_id'      => ['nullable', 'integer', 'exists:viviendas,id'],
            'fecha_resolucion' => ['nullable', 'date'],
        ]);

        $incidencia = Incidencia::create([
            'titulo'           => $request->titulo,
            'descripcion'      => $request->descripcion,
            'ubicacion'        => $request->ubicacion,
            'categoria'        => $request->categoria,
            'prioridad'        => $request->prioridad ?? 'baja',
            'estado'           => $request->estado,
            'usuario_id'       => $request->usuario_id,
            'vivienda_id'      => $request->vivienda_id,
            'fecha_resolucion' => $request->fecha_resolucion,
        ]);

        return response()->json($incidencia, 201);
    }

    public function show(Incidencia $incidencia)
    {
        return response()->json($incidencia, 200);
    }

    public function edit(Incidencia $incidencia)
    {
        //
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $incidencia->usuario_id !== $user->id) {
            return response()->json([
                'message' => 'No tienes permiso para modificar esta incidencia'
            ], 403);
        }

        $request->validate([
            'titulo'           => ['required', 'string', 'max:200'],
            'descripcion'      => ['required', 'string'],
            'ubicacion'        => ['required', 'string', 'max:255'],
            'categoria'        => ['required', 'string', 'max:50'],
            'prioridad'        => ['nullable', 'string', 'in:baja,media,alta'],
            'estado'           => ['required', 'string', 'max:50'],
            'usuario_id'       => ['required', 'integer', 'exists:users,id'],
            'vivienda_id'      => ['nullable', 'integer', 'exists:viviendas,id'],
            'fecha_resolucion' => ['nullable', 'date'],
        ]);

        $incidencia->update([
            'titulo'           => $request->titulo,
            'descripcion'      => $request->descripcion,
            'ubicacion'        => $request->ubicacion,
            'categoria'        => $request->categoria,
            'prioridad'        => $request->prioridad ?? 'baja',
            'estado'           => $request->estado,
            'usuario_id'       => $request->usuario_id,
            'vivienda_id'      => $request->vivienda_id,
            'fecha_resolucion' => $request->fecha_resolucion,
        ]);

        return response()->json($incidencia, 200);
    }

    public function destroy(Incidencia $incidencia, Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin' && $incidencia->usuario_id !== $user->id) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar esta incidencia'
            ], 403);
        }

        $incidencia->delete();
        return response()->json(['message' => 'Incidencia eliminada correctamente'], 200);
    }
}
