<?php

namespace App\Http\Controllers;

use App\Models\Acompaniante;
use Illuminate\Http\Request;

class AcompanianteController extends Controller
{
    /**
     * Mostrar todos los acompañantes.
     * GET /api/v1/acompañantes
     */
    public function index()
    {
        $acompañantes = Acompaniante::all();

        if ($acompañantes->isEmpty()) {
            return response()->json(['message' => 'No hay acompañantes registrados'], 200);
        }

        return response()->json($acompañantes, 200);
    }

    /**
     * Registrar un nuevo acompañante.
     * POST /api/v1/acompañantes
     */
    public function store(Request $request)
    {
        // ✅ Validamos los datos
        $validatedData = $request->validate([
            'Dni_acompañante' => 'required|string|max:20|unique:acompaniante,Dni_acompañante',
            'Nombre_apellido' => 'required|string|max:255',
            'Domicilio' => 'nullable|string|max:255',
            'Tipo_acompañante' => 'nullable|string|max:100'
        ], [
            'Dni_acompañante.required' => 'El DNI del acompañante es obligatorio.',
            'Dni_acompañante.unique' => 'Ya existe un acompañante con ese DNI.',
            'Nombre_apellido.required' => 'El nombre y apellido son obligatorios.'
        ]);

        // ✅ Creamos el registro
        $acompañante = Acompaniante::create($validatedData);

        // ✅ Respondemos con éxito
        return response()->json([
            'message' => 'Acompañante registrado correctamente.',
            'acompañante' => $acompañante
        ], 201);
    }

    /**
     * Mostrar un acompañante por su ID.
     * GET /api/v1/acompañantes/{id}
     */
    public function show($id)
    {
        $acompañante = Acompaniante::find($id);

        if (!$acompañante) {
            return response()->json(['message' => 'Acompañante no encontrado.'], 404);
        }

        return response()->json($acompañante, 200);
    }

    /**
     * Actualizar los datos de un acompañante existente.
     * PUT /api/v1/acompañantes/{id}
     */
    public function update(Request $request, $id)
    {
        $acompañante = Acompaniante::find($id);

        if (!$acompañante) {
            return response()->json(['message' => 'Acompañante no encontrado.'], 404);
        }

        // ✅ Validación flexible (solo los campos enviados)
        $validatedData = $request->validate([
            'Dni_acompañante' => "sometimes|required|string|max:20|unique:acompaniante,Dni_acompañante,{$id}",
            'Nombre_apellido' => 'sometimes|required|string|max:255',
            'Domicilio' => 'nullable|string|max:255',
            'Tipo_acompañante' => 'nullable|string|max:100'
        ], [
            'Dni_acompañante.unique' => 'Ya existe otro acompañante con ese DNI.'
        ]);

        // ✅ Actualizamos
        $acompañante->update($validatedData);

        return response()->json([
            'message' => 'Acompañante actualizado correctamente.',
            'acompañante' => $acompañante
        ], 200);
    }

    /**
     * Eliminar un acompañante.
     * DELETE /api/v1/acompañantes/{id}
     */
    public function destroy($id)
    {
        $acompañante = Acompaniante::find($id);

        if (!$acompañante) {
            return response()->json(['message' => 'Acompañante no encontrado.'], 404);
        }

        $acompañante->delete();

        return response()->json(['message' => 'Acompañante eliminado correctamente.'], 200);
    }
}
