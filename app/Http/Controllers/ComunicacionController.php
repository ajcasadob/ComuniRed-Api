<?php

namespace App\Http\Controllers;

use App\Models\Comunicacion;
use Illuminate\Http\Request;

class ComunicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comunicacion::all();
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
            'contenido' => ['required', 'string'],
            'tipo' => ['required', 'string', 'max:50'],
            'autor_id' => ['required', 'integer', 'exists:users,id'],
            'fecha_publicacion' => ['required', 'date'],
            'activa' => ['required', 'boolean']
        ]);
        
        $comunicacion = Comunicacion::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'tipo' => $request->tipo,
            'autor_id' => $request->autor_id,
            'fecha_publicacion' => $request->fecha_publicacion,
            'activa' => $request->activa
        ]);
        
        return response()->json($comunicacion, 201);
    }

    /**
     * Display the specified resource.
     */
    

    public function show($id)
    {
    $comunicacion = Comunicacion::find($id);
    return response()->json($comunicacion, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comunicacion $comunicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $comunicacion = Comunicacion::find($id);
        $data=$request->validate([
            'titulo' => ['required', 'string', 'max:200'],
            'contenido' => ['required', 'string'],
            'tipo' => ['required', 'string', 'max:50'],
            'autor_id' => ['required', 'integer', 'exists:users,id'],
            'fecha_publicacion' => ['required', 'date'],
            'activa' => ['required', 'boolean']
        ]);
        
        $comunicacion->update($data);
        return response()->json($comunicacion, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $comunicacion)
    {
        return Comunicacion::destroy($comunicacion);
    }
}
