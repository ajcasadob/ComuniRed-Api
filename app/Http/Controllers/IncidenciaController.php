<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Incidencia::all();
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
            'titulo' => ['required', 'string', 'max:200'],
            'descripcion' => ['required', 'string'],
            'ubicacion' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:50'],
            'estado' => ['required', 'string', 'max:50'],
            'usuario_id' => ['required', 'integer', 'exists:users,id'],
            'vivienda_id' => ['nullable', 'integer', 'exists:viviendas,id'],
            'fecha_resolucion' => ['nullable', 'date'],
            'imagen_url' => ['nullable', 'string', 'max:500']
        ]);
        
        $incidencia = Incidencia::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'ubicacion' => $request->ubicacion,
            'categoria' => $request->categoria,
            'estado' => $request->estado,
            'usuario_id' => $request->usuario_id,
            'vivienda_id' => $request->vivienda_id,
            'fecha_resolucion' => $request->fecha_resolucion,
            'imagen_url' => $request->imagen_url
        ]);
        
        return response()->json($incidencia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Incidencia $incidencia)
    {
        return response()->json($incidencia, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incidencia $incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incidencia $incidencia)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:200'],
            'descripcion' => ['required', 'string'],
            'ubicacion' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:50'],
            'estado' => ['required', 'string', 'max:50'],
            'usuario_id' => ['required', 'integer', 'exists:users,id'],
            'vivienda_id' => ['nullable', 'integer', 'exists:viviendas,id'],
            'fecha_resolucion' => ['nullable', 'date'],
            'imagen_url' => ['nullable', 'string', 'max:500']
        ]);
        
        $incidencia->update($request->all());
        return response()->json($incidencia, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $incidencia)
    {
        return Incidencia::destroy($incidencia);
    }
}
