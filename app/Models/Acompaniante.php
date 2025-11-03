<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acompaniante extends Model
{
    use HasFactory;

    protected $table = 'acompaniante';

    protected $fillable = [
        'Dni_acompañante',
        'Nombre_apellido',
        'Domicilio',
        'Tipo_acompañante'
    ];

    public function conductores()
    {
        return $this->belongsToMany(Conductor::class, 'acompaniante_id',);
    }
}