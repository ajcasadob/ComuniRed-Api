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
            'usuario_id' => ['required', 'integer', 'exists:users,id'],
            'fecha_reserva' => ['required', 'date'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'estado' => ['required', 'string', 'max:50']
        ]);
        
        $reserva = Reserva::create([
            'nombre_espacio' => $request->nombre_espacio,
            'usuario_id' => $request->usuario_id,
            'fecha_reserva' => $request->fecha_reserva,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'estado' => $request->estado
        ]);
        
        return response()->json($reserva->load('usuario.vivienda'), 201);
    }

    public function show(Reserva $reserva)
    {
        return response()->json($reserva->load('usuario.vivienda'), 200);
    }

    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'nombre_espacio' => ['required', 'string', 'max:100'],
            'usuario_id' => ['required', 'integer', 'exists:users,id'],
            'fecha_reserva' => ['required', 'date'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'estado' => ['required', 'string', 'max:50']
        ]);
        
        $reserva->update($request->all());
        return response()->json($reserva->load('usuario.vivienda'), 200);
    }

    public function destroy(int $reserva)
    {
        return Reserva::destroy($reserva);
    }
}
