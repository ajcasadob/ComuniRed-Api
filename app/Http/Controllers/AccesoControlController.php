<?php

namespace App\Http\Controllers;

use App\Models\AccesoControl;
use Illuminate\Http\Request;

class AccesoControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AccesoControl::all();
        //
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
            'tipo_acceso' => ['required', 'string', 'max:50'],
            'nombre_visitante' => ['required', 'string', 'max:100'],
            'matricula' => ['nullable', 'string', 'max:20'],
            'fecha_hora_entrada' => ['required', 'date'],
            'fecha_hora_salida' => ['nullable', 'date'],
            'vivienda_id' => ['required', 'integer', 'exists:viviendas,id']
        ]);
        
        $acceso_control = AccesoControl::create([
            'tipo_acceso' => $request->tipo_acceso,
            'nombre_visitante' => $request->nombre_visitante,
            'matricula' => $request->matricula,
            'fecha_hora_entrada' => $request->fecha_hora_entrada,
            'fecha_hora_salida' => $request->fecha_hora_salida,
            'vivienda_id' => $request->vivienda_id
        ]);
        
        return response()->json($acceso_control, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AccesoControl $accesoControl)
    {
        return response()->json($accesoControl, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccesoControl $accesoControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccesoControl $accesoControl)
    {
        $request->validate([
            'tipo_acceso' => ['required', 'string', 'max:50'],
            'nombre_visitante' => ['required', 'string', 'max:100'],
            'matricula' => ['nullable', 'string', 'max:20'],
            'fecha_hora_entrada' => ['required', 'date'],
            'fecha_hora_salida' => ['nullable', 'date'],
            'vivienda_id' => ['required', 'integer', 'exists:viviendas,id']
        ]);
        
        $accesoControl->update($request->all());
        return response()->json($accesoControl, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $accesoControl)
    {
        return AccesoControl::destroy($accesoControl);
    }
}
