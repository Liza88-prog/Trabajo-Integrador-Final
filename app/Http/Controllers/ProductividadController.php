<?php

namespace App\Http\Controllers;

use App\Models\Productividad;
use Illuminate\Http\Request;

class ProductividadController extends Controller
{
    /**
     * Muestra todas las productividades registradas
     */
    public function index()
    {
        $productividades = Productividad::with('personalControl')->get();

        return response()->json($productividades, 200);
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

        $productividad = Productividad::create($data);

        return response()->json([
            'message' => 'Productividad registrada correctamente',
            'productividad' => $productividad
        ], 201);
    }

    /**
     * Muestra una productividad específica
     */
    public function show(Productividad $productividad)
    {
        $productividad->load('personalControl');

        return response()->json($productividad, 200);
    }

    /**
     * Actualiza los datos de una productividad
     */
    public function update(Request $request, Productividad $productividad)
    {
        $data = $request->validate([
            'personal_control_id' => 'sometimes|required|integer|exists:personal_control,id',
            'fecha' => 'sometimes|required|date',
            'total_conductor' => 'sometimes|nullable|integer|min:0',
            'total_vehiculos' => 'sometimes|nullable|integer|min:0',
            'total_acompanante' => 'sometimes|nullable|integer|min:0',
        ]);

        $productividad->update($data);

        return response()->json([
            'message' => 'Productividad actualizada correctamente',
            'productividad' => $productividad
        ], 200);
    }

    /**
     * Elimina una productividad
     */
    public function destroy(Productividad $productividad)
    {
        $productividad->delete();

        return response()->json([
            'message' => 'Productividad eliminada correctamente'
        ], 204);
    }
}
