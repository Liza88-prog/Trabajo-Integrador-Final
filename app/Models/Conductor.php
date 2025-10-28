<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;

    protected $table = 'conductor';

    protected $fillable = [
        'acompaniante_id',
        'dni_conductor',
        'nombre_apellido',
        'domicilio',
        'categoria_carnet',
        'tipo_conductor',
        'vehiculo_id',
        'destino'
    ];

    public function acompaniante()
    {
        return $this->belongsTo(Acompaniante::class, 'acompaniante_id');
    }

    public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class, 'conductor_id');
    }
}