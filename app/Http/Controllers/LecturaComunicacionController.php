<?php

namespace App\Http\Controllers;

use App\Models\LecturaComunicacion;
use Illuminate\Http\Request;

class LecturaComunicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LecturaComunicacion::all();
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
            'comunicacion_id' => ['required', 'integer', 'exists:comunicacions,id'],
            'usuario_id' => ['required', 'integer', 'exists:users,id'],
            'fecha_lectura' => ['required', 'date']
        ]);
        
        $lectura_comunicacion = LecturaComunicacion::create([
            'comunicacion_id' => $request->comunicacion_id,
            'usuario_id' => $request->usuario_id,
            'fecha_lectura' => $request->fecha_lectura
        ]);
        
        return response()->json($lectura_comunicacion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LecturaComunicacion $lecturaComunicacion)
    {
        return response()->json($lecturaComunicacion, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LecturaComunicacion $lecturaComunicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LecturaComunicacion $lecturaComunicacion)
    {
        $request->validate([
            'comunicacion_id' => ['required', 'integer', 'exists:comunicacions,id'],
            'usuario_id' => ['required', 'integer', 'exists:users,id'],
            'fecha_lectura' => ['required', 'date']
        ]);
        
        $lecturaComunicacion->update($request->all());
        return response()->json($lecturaComunicacion, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $lecturaComunicacion)
    {
        return LecturaComunicacion::destroy($lecturaComunicacion);
    }
}
