<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Conductor::all();
        return response()->json(Conductor::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'acompaniante_id' => 'nullable|integer| 
    exists:acompaniante,id',
            'dni_conductor' => 'required|string|max:20|unique:conductor,dni_conductor',
            'nombre_apellido' => 'required|string|max:255',
            'domicilio' => 'nullable|string|max:255',
            'categoria_carnet' => 'nullable|string|max:50',
            'tipo_conductor' => 'nullable|string|max:50',
            'vehiculo_id' => 'nullable|integer|exists:vehiculos,id',
            'destino' => 'nullable|string|max:255',
        ]);

        $conductor = Conductor::create($data);

        return response()->json([
            'message' => 'Conductor registrado correctamente',
            'conductor' => $conductor
        ], 201);
    }

    public function show(Conductor $conductor)
    {
        return response()->json($conductor, 200);
    }
//exists:acompaniante,id' va en acompañante_id
    public function update(Request $request, Conductor $conductor)
{
    $data = $request->validate([
        'acompaniante_id' => 'sometimes|nullable|integer|exists:acompaniante,id',
        'dni_conductor' => "sometimes|required|string|max:20|unique:conductor,dni_conductor,{$conductor->id}",
        'nombre_apellido' => 'sometimes|required|string|max:255',
        'domicilio' => 'sometimes|nullable|string|max:255',
        'categoria_carnet' => 'sometimes|nullable|string|max:50',
        'tipo_conductor' => 'sometimes|nullable|string|max:50',
        'vehiculo_id' => 'sometimes|nullable|integer|exists:vehiculos,id',
        'destino' => 'sometimes|nullable|string|max:255',
    ]);

    $conductor->update($data);

    return response()->json([
        'message' => 'Conductor actualizado correctamente',
        'conductor' => $conductor
    ], 200);
}

    public function destroy(Conductor $conductor)
    {
        $conductor->delete();
        return response()->json(null, 204);
    }
}
