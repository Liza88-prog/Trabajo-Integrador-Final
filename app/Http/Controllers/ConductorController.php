<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Acompaniante;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    // Mostrar todos los conductores
    public function index()
    {
        $conductores = Conductor::all();
        return view('modules.Conductor.index', compact('conductores'));
    }

    // Mostrar formulario para crear un conductor
    public function create()
    {
        return view('modules.Conductor.create');
    }

    // Guardar un nuevo conductor
    public function store(Request $request)
    {
        $data = $request->validate([
            'acompaniante_id' => 'nullable|integer|exists:acompaniante,id',
            'dni_conductor' => 'required|string|max:20|unique:conductor,dni_conductor',
            'nombre_apellido' => 'required|string|max:255',
            'domicilio' => 'nullable|string|max:255',
            'categoria_carnet' => 'nullable|string|max:50',
            'tipo_conductor' => 'nullable|string|max:50',
            'destino' => 'nullable|string|max:255',
        ]);

        $conductor = Conductor::create($data);

        return redirect()->route('conductores.index')->with('success', 'Conductor registrado correctamente');
    }

    // Mostrar un conductor
    public function show(Conductor $conductor)
    {
        return view('modules.Conductor.show', compact('conductor'));
    }

    // Mostrar formulario para editar un conductor
    public function edit(Conductor $conductor)
    {
        $acompañantes = Acompaniante::all(); // Trae todos los acompañantes
    
        return view('modules.Conductor.edit', compact('conductor', 'acompañantes'));
    }

    // Actualizar conductor
    public function update(Request $request, Conductor $conductor)
    {
        $data = $request->validate([
            'acompaniante_id' => 'sometimes|nullable|integer|exists:acompaniante,id',
            'dni_conductor' => "sometimes|required|string|max:20|unique:conductor,dni_conductor,{$conductor->id}",
            'nombre_apellido' => 'sometimes|required|string|max:255',
            'domicilio' => 'sometimes|nullable|string|max:255',
            'categoria_carnet' => 'sometimes|nullable|string|max:50',
            'tipo_conductor' => 'sometimes|nullable|string|max:50',
            'destino' => 'sometimes|nullable|string|max:255',
        ]);

        $conductor->update($data);

        return redirect()->route('conductores.index')->with('success', 'Conductor actualizado correctamente');
    }

    // Eliminar conductor
    public function destroy(Conductor $conductor)
    {
        $conductor->delete();
        return redirect()->route('conductores.index')->with('success', 'Conductor eliminado correctamente');
    }
}
