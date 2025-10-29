@extends('layouts.app') {{-- usa tu layout principal --}}

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Registrar nueva productividad</h2>

    {{-- Muestra errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Atención:</strong> corrige los siguientes errores:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('productividades.store') }}" method="POST">
        @csrf {{-- token obligatorio para evitar error 419 --}}

        <div class="mb-3">
            <label for="personal_control_id" class="form-label">Personal Control ID</label>
            <input type="number" name="personal_control_id" id="personal_control_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_conductor" class="form-label">Total Conductores</label>
            <input type="number" name="total_conductor" id="total_conductor" class="form-control" min="0" required>
        </div>

        <div class="mb-3">
            <label for="total_vehiculos" class="form-label">Total Vehículos</label>
            <input type="number" name="total_vehiculos" id="total_vehiculos" class="form-control" min="0" required>
        </div>

        <div class="mb-3">
            <label for="total_acompanante" class="form-label">Total Acompañantes</label>
            <input type="number" name="total_acompanante" id="total_acompanante" class="form-control" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('productividades.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
