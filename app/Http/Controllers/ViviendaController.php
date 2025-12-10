<?php

namespace App\Http\Controllers;

use App\Models\Vivienda;
use Illuminate\Http\Request;

class ViviendaController extends Controller
{
    // GET /api/viviendas - Listar todas las viviendas
    public function index()
    {
        $viviendas = Vivienda::with(['accesosControl', 'incidencias', 'pagos'])->get();
        return response()->json($viviendas);
    }

    // POST /api/viviendas - Crear una nueva vivienda
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_vivienda' => 'required|string|max:10|unique:viviendas',
            'bloque' => 'nullable|string|max:10',
            'piso' => 'nullable|string|max:10',
            'puerta' => 'nullable|string|max:10',
            'metros_cuadrados' => 'nullable|numeric|min:0',
            'tipo' => 'required|string|max:20|in:piso,local,garaje',
        ]);

        $vivienda = Vivienda::create($validated);
        return response()->json($vivienda, 201);
    }

    // GET /api/viviendas/{id} - Mostrar una vivienda específica
    public function show($id)
    {
        $vivienda = Vivienda::with(['accesosControl', 'incidencias', 'pagos'])->findOrFail($id);
        return response()->json($vivienda);
    }

    // PUT/PATCH /api/viviendas/{id} - Actualizar una vivienda
    public function update(Request $request, $id)
    {
        $vivienda = Vivienda::findOrFail($id);

        $validated = $request->validate([
            'numero_vivienda' => 'sometimes|string|max:10|unique:viviendas,numero_vivienda,' . $id,
            'bloque' => 'nullable|string|max:10',
            'piso' => 'nullable|string|max:10',
            'puerta' => 'nullable|string|max:10',
            'metros_cuadrados' => 'nullable|numeric|min:0',
            'tipo' => 'sometimes|string|max:20|in:piso,local,garaje',
        ]);

        $vivienda->update($validated);
        return response()->json($vivienda);
    }

    // DELETE /api/viviendas/{id} - Eliminar una vivienda
    public function destroy($id)
    {
        $vivienda = Vivienda::findOrFail($id);
        $vivienda->delete();
        return response()->json(['message' => 'Vivienda eliminada correctamente'], 200);
    }
}
