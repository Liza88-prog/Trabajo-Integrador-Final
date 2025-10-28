<?php

namespace App\Http\Controllers;

use App\Models\Novedad;
use Illuminate\Http\Request;

class NovedadController extends Controller
{
    /**
     * Muestra todas las novedades (GET /api/v1/novedades)
     */
    public function index()
    {
        $novedades = Novedad::with('vehiculo')->get();

        return response()->json([
            'message' => 'Listado de novedades obtenido correctamente',
            'data' => $novedades
        ], 200);
    }

    /**
     * Crea una nueva novedad (POST /api/v1/novedades)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'vehiculo_id' => 'required|integer|exists:vehiculo,id',
            'tipo_novedad' => 'required|string|max:100',
            'aplica' => 'required|string|max:50',
            'observaciones' => 'nullable|string|max:255'
        ]);

        $novedad = Novedad::create($data);

        return response()->json([
            'message' => 'Novedad registrada correctamente',
            'data' => $novedad
        ], 201);
    }

    /**
     * Muestra una novedad por su ID (GET /api/v1/novedades/{id})
     */
    public function show($id)
    {
        $novedad = Novedad::with('vehiculo')->find($id);

        if (!$novedad) {
            return response()->json([
                'message' => 'Novedad no encontrada'
            ], 404);
        }

        return response()->json($novedad, 200);
    }

    /**
     * Actualiza una novedad existente (PUT/PATCH /api/v1/novedades/{id})
     */
    public function update(Request $request, Novedad $novedad)
    {
        $data = $request->validate([
            'vehiculo_id' => 'sometimes|integer|exists:vehiculo,id',
            'tipo_novedad' => 'sometimes|string|max:100',
            'aplica' => 'sometimes|string|max:50',
            'observaciones' => 'sometimes|nullable|string|max:255'
        ]);

        $novedad->update($data);

        return response()->json([
            'message' => 'Novedad actualizada correctamente',
            'data' => $novedad
        ], 200);
    }

    /**
     * Elimina una novedad (DELETE /api/v1/novedades/{id})
     */
    public function destroy(Novedad $novedad)
    {
        $novedad->delete();

        return response()->json([
            'message' => 'Novedad eliminada correctamente'
        ], 200);
    }
}
