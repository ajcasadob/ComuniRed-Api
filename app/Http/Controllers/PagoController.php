<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        return Pago::with(['vivienda'])->get(); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'vivienda_id' => ['required', 'integer', 'exists:viviendas,id'],
            'concepto' => ['required', 'string', 'max:200'],
            'periodo' => ['required', 'string', 'max:50'],
            'importe' => ['required', 'numeric', 'min:0'],
            'estado' => ['required', 'string', 'max:50'],
            'fecha_vencimiento' => ['required', 'date'],
            'fecha_pago' => ['nullable', 'date']
        ]);
        
        $pago = Pago::create([
            'vivienda_id' => $request->vivienda_id,
            'concepto' => $request->concepto,
            'periodo' => $request->periodo,
            'importe' => $request->importe,
            'estado' => $request->estado,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'fecha_pago' => $request->fecha_pago
        ]);
        
        return response()->json($pago->load('vivienda'), 201); 
    }

    public function show(Pago $pago)
    {
        return response()->json($pago->load('vivienda'), 200); 
    }

    public function update(Request $request, Pago $pago)
    {
        $request->validate([
            'vivienda_id' => ['required', 'integer', 'exists:viviendas,id'],
            'concepto' => ['required', 'string', 'max:200'],
            'periodo' => ['required', 'string', 'max:50'],
            'importe' => ['required', 'numeric', 'min:0'],
            'estado' => ['required', 'string', 'max:50'],
            'fecha_vencimiento' => ['required', 'date'],
            'fecha_pago' => ['nullable', 'date']
        ]);
        
        $pago->update($request->all());
        return response()->json($pago->load('vivienda'), 200); 
    }

    public function destroy(int $pago)
    {
        return Pago::destroy($pago);
    }
}
