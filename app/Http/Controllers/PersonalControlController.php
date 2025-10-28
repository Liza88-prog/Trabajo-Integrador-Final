<?php

namespace App\Http\Controllers;

use App\Models\PersonalControl;
use Illuminate\Http\Request;

class PersonalControlController extends Controller
{
    /**
     * 📋 Mostrar todos los registros de personal control.
     * GET /api/v1/personal-control
     */
    public function index()
    {
        $personal = PersonalControl::with('rol')->get();

        return response()->json([
        'message' => 'Listado de personal de control obtenido correctamente',
        'data' => $personal
    ], 200);
    }

    /**
     * 🆕 Crear un nuevo registro de personal control.
     * POST /api/v1/personal-control
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_apellido'   => 'required|string|max:255',
            'lejago_personal'   => 'required|string|max:50',
            'dni'               => 'required|numeric|digits_between:7,10|unique:personal_control,dni',
            'jerarquia'         => 'nullable|string|max:100',
            'rol_en_control'    => 'nullable|string|max:100',
            'rol_id'            => 'required|exists:roles,id', // ✅ agregado después de rol_en_control
            'fecha_control'     => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
            'lugar'             => 'required|string|max:255',
            'ruta'              => 'nullable|string|max:255'
        ]);

        $personal = PersonalControl::create($validated);

        return response()->json([
            'message' => 'Personal de control registrado correctamente',
            'data' => $personal
        ], 201);
    }

    /**
     * 🔍 Mostrar un registro específico.
     * GET /api/v1/personal-control/{id}
     */
    public function show($id)
    {
        $personal = PersonalControl::with('rol')->find($id);

        if (!$personal) {
            return response()->json(['message' => 'Personal no encontrado'], 404);
        }

        return response()->json($personal, 200);
    }

    /**
     * ✏️ Actualizar un registro existente.
     * PUT /api/v1/personal-control/{id}
     */
    public function update(Request $request, $id)
    {
        $personal = PersonalControl::find($id);

        if (!$personal) {
            return response()->json(['message' => 'Personal no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre_apellido'   => 'sometimes|required|string|max:255',
            'lejago_personal'   => 'sometimes|required|string|max:50',
            'dni'               => "sometimes|required|numeric|digits_between:7,10|unique:personal_control,dni,{$id}",
            'jerarquia'         => 'nullable|string|max:100',
            'rol_en_control'    => 'nullable|string|max:100',
            'rol_id'            => 'sometimes|required|exists:roles,id', // ✅ agregado después de rol_en_control
            'fecha_control'     => 'sometimes|required|date',
            'hora_inicio' => 'required|date_format:H:i', // formato HH:MM
            'hora_fin' => 'required|date_format:H:i',
            'lugar'             => 'sometimes|required|string|max:255',
            'ruta'              => 'nullable|string|max:255'
        ]);

        $personal->update($validated);

        return response()->json([
            'message' => 'Personal de control actualizado correctamente',
            'data' => $personal
        ], 200);
    }

    /**
     * 🗑️ Eliminar un registro.
     * DELETE /api/v1/personal-control/{id}
     */
    public function destroy($id)
    {
        $personal = PersonalControl::find($id);

        if (!$personal) {
            return response()->json(['message' => 'Personal no encontrado'], 404);
        }

        $personal->delete();

        return response()->json(['message' => 'Personal eliminado correctamente'], 200);
    }
}