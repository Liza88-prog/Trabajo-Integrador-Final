<?php

namespace App\Http\Controllers;

use App\Models\Acompaniante;
use App\Models\Conductor;
use App\Models\Productividad;
use App\Models\PersonalControl;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class ProductividadController extends Controller
{
    /**
     * Muestra todas las productividades registradas
     */
    public function index()
    {
        $productividades = Productividad::with('personalcontrol')->get();

         // Calcular totales automáticos desde la base de datos
                $totalConductores = \App\Models\Conductor::count();
                $totalVehiculos = \App\Models\Vehiculo::count();
                $totalAcompanantes = \App\Models\Acompaniante::count();

            return view('modules.Productividad.index', compact('productividades',
        'totalConductores',
        'totalVehiculos',
        'totalAcompanantes'));
    }

    /**
     * Muestra el formulario para crear una nueva productividad
     */
    public function create()
    {
        $personalcontrols = PersonalControl::all();

         // 🔹 Obtener totales actuales
            $total_conductores = \App\Models\Conductor::count();
            $total_vehiculos = \App\Models\Vehiculo::count();
            $total_acompanantes = \App\Models\Acompaniante::count();

        return view('modules.Productividad.create', compact('personalcontrols', 'total_conductores', 'total_vehiculos', 'total_acompanantes' ));
    }

    /**
     * Registra una nueva productividad
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'personal_control_id' => 'required|integer|exists:personal_control,id',
            'fecha' => 'required|date'
        ]);

         // Calcular los totales al guardar
        $data['total_conductor'] = Conductor::count();
        $data['total_vehiculos'] = Vehiculo::count();
        $data['total_acompanante'] = Acompaniante::count();



        Productividad::create($data);

        return redirect()->route('productividades.index')
                        ->with('success', 'Productividad registrada correctamente.');
    }

    /**
     * Muestra el detalle de una productividad
     */
    public function show(Productividad $productividad)
    {
        $productividad->load('personalcontrol');
        return view('modules.Productividad.show', compact('productividad'));
    }

    /**
     * Muestra el formulario para editar una productividad
     */
    public function edit(Productividad $productividad)
    {
        $personalcontrols = PersonalControl::all();
        return view('modules.Productividad.edit', compact('productividad', 'personalcontrols'));
    }

    public function update(Request $request, Productividad $productividad)
    {
        $data = $request->validate([
            'personal_control_id' => 'required|integer|exists:personal_control,id',
            'fecha' => 'required|date'
        ]);

        // Recalcular los totales al actualizar
        $data['total_conductor'] = Conductor::count();
        $data['total_vehiculos'] = Vehiculo::count();
        $data['total_acompanante'] = Acompaniante::count();

        $productividad->update($data);

        return redirect()->route('productividades.show', $productividad->id)
                        ->with('success', 'Productividad actualizada correctamente.');
    }

    /**
     * Elimina una productividad
     */
    public function destroy(Productividad $productividad)
    {
        $productividad->delete();

        return redirect()->route('productividades.index')
                        ->with('success', 'Productividad eliminada correctamente.');
    }
}
