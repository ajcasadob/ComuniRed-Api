<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Reserva::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
        
        return response()->json($reserva, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        return response()->json($reserva, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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
        return response()->json($reserva, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $reserva)
    {
        return Reserva::destroy($reserva);
    }
}
