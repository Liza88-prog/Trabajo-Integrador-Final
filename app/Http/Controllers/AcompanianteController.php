<?php

namespace App\Http\Controllers;

use App\Models\Acompaniante;
use Illuminate\Http\Request;

class AcompanianteController extends Controller
{
    // 🔹 Mostrar todos los acompañantes
    public function index()
    {
        $acompañantes = Acompaniante::all();
        return view('modules.Acompaniante.index', compact('acompañantes'));
    }

    // 🔹 Mostrar formulario para crear
    public function create()
    {
        return view('modules.Acompaniante.create');
    }

    // 🔹 Guardar nuevo acompañante
    public function store(Request $request)
    {
        $data = $request->validate([
            'Dni_acompañante' => 'required|string|max:20|unique:acompaniante,Dni_acompañante',
            'Nombre_apellido' => 'required|string|max:255',
            'Domicilio' => 'nullable|string|max:255',
            'Tipo_acompañante' => 'nullable|string|max:100',
        ]);

        Acompaniante::create($data);

        return redirect()->route('acompaniante.index')->with('success', 'Acompañante registrado correctamente.');
    }

    // 🔹 Mostrar detalle
    public function show(Acompaniante $acompaniante)
    {
        return view('modules.Acompaniante.show', compact('acompaniante'));
    }

    // 🔹 Mostrar formulario de edición
    public function edit(Acompaniante $acompaniante)
    {
        return view('modules.Acompaniante.edit', compact('acompaniante'));
    }

    // 🔹 Actualizar
    public function update(Request $request, Acompaniante $acompaniante)
    {
        $data = $request->validate([
            'Dni_acompañante' => "required|string|max:20|unique:acompaniante,Dni_acompañante,{$acompaniante->id}",
            'Nombre_apellido' => 'required|string|max:255',
            'Domicilio' => 'nullable|string|max:255',
            'Tipo_acompañante' => 'nullable|string|max:100',
        ]);

        $acompaniante->update($data);

        return redirect()->route('acompaniante.index')->with('success', 'Acompañante actualizado correctamente.');
    }

    // 🔹 Eliminar
    public function destroy(Acompaniante $acompaniante)
    {
        $acompaniante->delete();
        return redirect()->route('acompaniante.index')->with('success', 'Acompañante eliminado correctamente.');
    }
}
