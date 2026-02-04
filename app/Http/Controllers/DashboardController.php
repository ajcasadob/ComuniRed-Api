<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Incidencia;
use App\Models\Pago;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getEstadisticas()
    {
        $hoy = Carbon::now();
        
        // Reservas activas (confirmadas y futuras)
        $reservasActivas = Reserva::where('fecha_reserva', '>=', $hoy)
            ->whereIn('estado', ['confirmada', 'pendiente'])
            ->count();
        
        // Incidencias pendientes
        $incidenciasPendientes = Incidencia::whereIn('estado', ['pendiente', 'en proceso'])
            ->count();
        
        // Incidencias urgentes
        $incidenciasUrgentes = Incidencia::whereIn('estado', ['pendiente', 'en proceso'])
            ->where(function($query) {
                $query->where('categoria', 'LIKE', '%urgente%')
                    ->orWhere('categoria', 'LIKE', '%alta%');
            })
            ->count();
        
        // Tasa de cobro
        $totalPagos = Pago::sum('importe');
        $pagosPagados = Pago::where('estado', 'pagado')->sum('importe');
        $tasaCobro = $totalPagos > 0 ? ($pagosPagados / $totalPagos) * 100 : 0;
        
        // Vecinos registrados (usuarios con role 'user')
        $vecinosRegistrados = User::where('role', 'user')->count();
        
        // Ocupación de instalaciones (esta semana)
        $inicioSemana = Carbon::now()->startOfWeek();
        $finSemana = Carbon::now()->endOfWeek();
        
        $instalaciones = [
            ['nombre' => 'Pistas de Pádel', 'clave' => 'padel'],
            ['nombre' => 'Gimnasio', 'clave' => 'gimnasio'],
            ['nombre' => 'Sala Gourmet', 'clave' => 'gourmet'],
            ['nombre' => 'Mesa Ping Pong', 'clave' => 'ping pong']
        ];
        
        $ocupacion = [];
        foreach ($instalaciones as $inst) {
            $reservasSemana = Reserva::where('nombre_espacio', 'LIKE', "%{$inst['clave']}%")
                ->whereBetween('fecha_reserva', [$inicioSemana, $finSemana])
                ->count();
            
            // Asumiendo 7 días x 5 horarios disponibles = 35 slots por semana
            $slotsDisponibles = 35;
            $porcentaje = $slotsDisponibles > 0 
                ? min(($reservasSemana / $slotsDisponibles) * 100, 100) 
                : 0;
            
            $ocupacion[] = [
                'nombre' => $inst['nombre'],
                'clave' => $inst['clave'],
                'porcentaje' => round($porcentaje, 0)
            ];
        }
        
        return response()->json([
            'reservas_activas' => $reservasActivas,
            'incidencias_pendientes' => $incidenciasPendientes,
            'incidencias_urgentes' => $incidenciasUrgentes,
            'tasa_cobro' => round($tasaCobro, 1),
            'vecinos_registrados' => $vecinosRegistrados,
            'ocupacion_instalaciones' => $ocupacion
        ]);
    }
}
