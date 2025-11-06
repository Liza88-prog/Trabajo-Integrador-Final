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
        'destino'
    ];

    /**
     *  Relación: un conductor tiene muchos acompañantes
     */
    public function acompaniante()
    {
        return $this->hasMany(Acompaniante::class, 'conductor_id');
    }

    public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class, 'conductor_id');
    }


}