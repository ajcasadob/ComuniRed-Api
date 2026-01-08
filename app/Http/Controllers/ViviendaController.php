<?php

namespace App\Http\Controllers;

use App\Models\Vivienda;
use Illuminate\Http\Request;

class ViviendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vivienda::all();
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
            'numero_vivienda' => ['required', 'string', 'max:10', 'unique:viviendas'],
            'bloque' => ['nullable', 'string', 'max:10'],
            'piso' => ['nullable', 'string', 'max:10'],
            'puerta' => ['nullable', 'string', 'max:10'],
            'metros_cuadrados' => ['nullable', 'numeric', 'min:0'],
            'tipo' => ['required', 'string', 'max:20', 'in:piso,local,garaje']
        ]);

        $vivienda = Vivienda::create([
            'numero_vivienda' => $request->numero_vivienda,
            'bloque' => $request->bloque,
            'piso' => $request->piso,
            'puerta' => $request->puerta,
            'metros_cuadrados' => $request->metros_cuadrados,
            'tipo' => $request->tipo
        ]);
        
        return response()->json($vivienda, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vivienda $vivienda)
    {
        return response()->json($vivienda, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vivienda $vivienda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vivienda $vivienda)
    {
        $request->validate([
            'numero_vivienda' => ['required', 'string', 'max:10', 'unique:viviendas,numero_vivienda,' . $vivienda->id],
            'bloque' => ['nullable', 'string', 'max:10'],
            'piso' => ['nullable', 'string', 'max:10'],
            'puerta' => ['nullable', 'string', 'max:10'],
            'metros_cuadrados' => ['nullable', 'numeric', 'min:0'],
            'tipo' => ['required', 'string', 'max:20', 'in:piso,local,garaje']
        ]);
        
        $vivienda->update($request->all());
        return response()->json($vivienda, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $vivienda)
    {
        return Vivienda::destroy($vivienda);
    }
}
