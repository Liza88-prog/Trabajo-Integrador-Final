<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;


class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //// GET /api/v1/vehiculos
    public function index()
    {
        $vehiculo = Vehiculo::all();

        return response()->json($vehiculo);
    }

    /**
     * Store a newly created resource in storage.
     */
    //// POST /api/v1/vehiculos
    public function store(Request $request)
{
    // Validamos los datos
    $data = $request->validate([
        'personal_control_id' => 'required|exists:personal_control,id',
        'conductor_id' => 'required|exists:conductor,id',
        'fecha_hora_control' => 'required|date_format:Y-m-d H:i:s',
        'marca_modelo' => 'required|string|max:255',
        'dominio' => 'required|string|max:20|unique:vehiculo,dominio',
        'color' => 'nullable|string|max:50'
    ]);

    // Creamos el vehículo
    $vehiculo = Vehiculo::create($data);

    // Si por algún motivo no se crea, devolvemos error
    if (!$vehiculo) {
        return response()->json(['message' => 'No se pudo crear el vehículo'], 500);
    }

    // ✅ Devolvemos el resultado con status 201 (Created)
    return response()->json([
        'message' => 'Vehículo registrado correctamente',
        'vehiculo' => $vehiculo
    ], 201);
}

    /**
     * Display the specified resource.
     */
    /// GET /api/v1/vehiculos/{id}
    public function show(string $id)
    {
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehiculo no encontrado'], 404);
        }

        return response()->json($vehiculo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    // PUT /api/v1/vehiculos/{id}
    public function update(Request $request, string $id)
    {
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehiculo no encontrado'], 404);
        }

        $data = $request->validate([
            'personal_control_id' => 'sometimes|required|exists:personal_control,id',
            'conductor_id' => 'sometimes|required|exists:conductor,id',
            'fecha_hora_control' => 'sometimes|required|date_format:Y-m-d H:i:s',
            'marca_modelo' => 'sometimes|required|string|max:255',
            'dominio' => "sometimes|required|string|max:20|unique:vehiculo,dominio,{$id}",
            'color' => 'nullable|string|max:50'
        ]);

        $vehiculo->update($data);

        return response()->json([
            'message' => 'Vehiculo actualizado correctamente',
            'vehiculo' => $vehiculo
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    /// DELETE /api/v1/vehiculos/{id}
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return response()->json(null, 204);
    }
}