<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['usuario.vivienda'])
            ->orderBy('fecha_reserva', 'desc')
            ->orderBy('hora_inicio', 'desc')
            ->get();

        return response()->json($reservas, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_espacio' => ['required', 'string', 'max:100'],
            'usuario_id'     => ['required', 'integer', 'exists:users,id'],
            'fecha_reserva'  => ['required', 'date'],
            'hora_inicio'    => ['required', 'date_format:H:i'],
            'hora_fin'       => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'estado'         => ['required', 'string', 'max:50'],
        ]);

        $reserva = Reserva::create([
            'nombre_espacio' => $request->nombre_espacio,
            'usuario_id'     => $request->usuario_id,
            'fecha_reserva'  => $request->fecha_reserva,
            'hora_inicio'    => $request->hora_inicio,
            'hora_fin'       => $request->hora_fin,
            'estado'         => $request->estado,
        ]);

        return response()->json($reserva->load('usuario.vivienda'), 201);
    }

    public function show(Reserva $reserva)
    {
        return response()->json($reserva->load('usuario.vivienda'), 200);
    }

   public function update(Request $request, Reserva $reserva)
{
    $user = $request->user();

    // Si no es admin y no es el dueño → 403
    if ($user->role !== 'admin' && $reserva->usuario_id !== $user->id) {
        return response()->json([
            'message' => 'No tienes permiso para modificar esta reserva'
        ], 403);
    }

    $request->validate([
        'nombre_espacio' => ['required', 'string', 'max:100'],
        'usuario_id'     => ['required', 'integer', 'exists:users,id'],
        'fecha_reserva'  => ['required', 'date'],
        'hora_inicio'    => ['required', 'date_format:H:i'],
        'hora_fin'       => ['required', 'date_format:H:i', 'after:hora_inicio'],
        'estado'         => ['required', 'string', 'max:50'],
    ]);

    $reserva->update($request->all());
    return response()->json($reserva->load('usuario.vivienda'), 200);
}

public function destroy(Reserva $reserva, Request $request)
{
    $user = $request->user();

    if ($user->role !== 'admin' && $reserva->usuario_id !== $user->id) {
        return response()->json([
            'message' => 'No tienes permiso para eliminar esta reserva'
        ], 403);
    }

    $reserva->delete();
    return response()->json(['message' => 'Reserva eliminada correctamente'], 200);
}

}
