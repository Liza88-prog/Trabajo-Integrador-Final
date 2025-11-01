<?php

namespace App\Http\Controllers;

use App\Models\PersonalControl;
use Illuminate\Http\Request;

class PersonalControlController extends Controller
{
    /**
     * 📋 Muestra una lista de recursos. (VIEW)
     */
    public function index()
    {
        // 1. Obtener los datos con su relación
        $personalControls = PersonalControl::with('rol')->get();

        // 2. Devolver la vista con los datos
        return view('modules.PersonalControl.index', compact('personalControls'));
    }

    /**
     * 🆕 Muestra el formulario para crear un nuevo recurso. (VIEW)
     */
    public function create()
    {
        // Si necesitas datos para el formulario (ej: roles), cárgalos aquí.
        $roles = \App\Models\Rol::all();

        return view('modules.PersonalControl.create', compact('roles')); // compact('roles') si es necesario
    }

    /**
     * 💾 Almacena un recurso recién creado. (ACTION)
     */
    public function store(Request $request)
    {
        // El código de validación y creación sigue siendo válido
        $validated = $request->validate([
            'nombre_apellido'   => 'required|string|max:255',
            'lejago_personal'   => 'required|string|max:50',
            'dni'               => 'required|numeric|digits_between:7,10|unique:personal_control,dni',
            'jerarquia'         => 'nullable|string|max:100',
            'rol_en_control'    => 'nullable|string|max:100',
            'rol_id'            => 'required|exists:roles,id',
            'fecha_control'     => 'nullable|date',
            'hora_inicio'       => 'nullable|date_format:H:i',
            'hora_fin'          => 'nullable|date_format:H:i',
            'lugar'             => 'nullable|string|max:255',
            'ruta'              => 'nullable|string|max:255',
            // ... (resto de validaciones)
        ]);

        PersonalControl::create($validated);

        // Redirigir a la lista de registros con un mensaje de éxito
        return redirect()->route('personalcontrol.index')->with('success', 'Personal de control registrado correctamente.');
    }

    /**
     * ✏️ Muestra el formulario para editar el recurso especificado. (VIEW)
     */
    public function edit(PersonalControl $personal_control) // Usamos Inyección de Modelo
    {
        // La variable $personal_control ya tiene el registro cargado gracias a la inyección
        // Si necesitas datos para el formulario (ej: roles), cárgalos aquí.
        $roles = \App\Models\Rol::all();

        return view('modules.PersonalControl.edit', compact('personal_control', 'roles')); // compact('personal_control', 'roles')
    }

    /**
     * 💾 Actualiza el recurso especificado. (ACTION)
     */
    public function update(Request $request, PersonalControl $personal_control)
    {
        // El código de validación y actualización necesita un ajuste en 'dni'
         $validated = $request->validate([
            'nombre_apellido'   => 'sometimes|required|string|max:255',
            'lejago_personal'   => 'sometimes|required|string|max:50',
            // Importante: Ignorar el DNI del registro actual para la validación unique
            'dni'               => 'sometimes|required|numeric|digits_between:7,10|unique:personal_control,dni,' . $personal_control->id,
            'jerarquia'         => 'nullable|string|max:100',
            'rol_en_control'    => 'nullable|string|max:100',
            'rol_id'            => 'sometimes|required|exists:roles,id',
            'fecha_control'     => 'nullable|date',
            'hora_inicio'       => 'nullable|date_format:H:i',
            'hora_fin'          => 'nullable|date_format:H:i',
            'lugar'             => 'nullable|string|max:255',

            // ... (resto de validaciones)
        ]);

        $personal_control->update($validated);

        return redirect()->route('personalcontrol.index')->with('success', 'Personal de control actualizado correctamente.');
    }

    /**
     * 🗑️ Elimina el recurso especificado. (ACTION)
     */
    public function destroy(PersonalControl $personal_control)
    {
        $personal_control->delete();

        return redirect()->route('personalcontrol.index')->with('success', 'Personal eliminado correctamente.');
    }



    // Los métodos `show` y los códigos originales de API son ahora redundantes, puedes eliminarlos.
    // Si quieres un endpoint API para el show, deberías usar otra ruta fuera de `Route::resource`
    // o hacer un controlador diferente solo para la API.
}