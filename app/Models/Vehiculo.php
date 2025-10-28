<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculo';

    protected $fillable = [
        'personal_control_id', // 🆕 Nuevo campo
        'conductor_id',
        'fecha_hora_control',
        'marca_modelo',
        'dominio',
        'color'
    ];

    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'conductor_id');
    }

    public function novedades()
    {
        return $this->hasMany(Novedad::class, 'vehiculo_id');
    }

    // 🆕 Cada vehículo fue controlado por un personal
    public function personalControl()
    {
        return $this->belongsTo(PersonalControl::class, 'personal_control_id');
    }
}