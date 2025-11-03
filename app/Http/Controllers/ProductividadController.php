<?php

namespace App\Http\Controllers;

use App\Models\Productividad;
use App\Models\PersonalControl;
use Illuminate\Http\Request;

class ProductividadController extends Controller
{
    /**
     * Muestra todas las productividades registradas
     */
    public function index()
    {
        $productividades = Productividad::with('personalcontrol')->get();
        return view('modules.Productividad.index', compact('productividades'));
    }

    /**
     * Muestra el formulario para crear una nueva productividad
     */
    public function create()
    {
        $personalcontrols = PersonalControl::all();
        return view('modules.Productividad.create', compact('personalcontrols'));
    }

    /**
     * Registra una nueva productividad
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'personal_control_id' => 'required|integer|exists:personal_control,id',
            'fecha' => 'required|date',
            'total_conductor' => 'nullable|integer|min:0',
            'total_vehiculos' => 'nullable|integer|min:0',
            'total_acompanante' => 'nullable|integer|min:0',
        ]);

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
            'fecha' => 'required|date',
            'total_conductor' => 'nullable|integer|min:0',
            'total_vehiculos' => 'nullable|integer|min:0',
            'total_acompanante' => 'nullable|integer|min:0',
        ]);

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
