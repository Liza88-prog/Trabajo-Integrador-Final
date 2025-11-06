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
        'Tipo_acompañante',
        'conductor_id'
    ];

   /**
     * 🔹 Relación: un acompañante pertenece a un conductor
     */
    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'conductor_id');
    }


}