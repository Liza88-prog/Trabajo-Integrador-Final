<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalControl extends Model
{
    use HasFactory;

    protected $table = 'personal_control';

    protected $fillable = [
        'nombre_apellido',
        'lejago_personal',
        'dni',
        'jerarquia',
        'rol_en_control',
        'rol_id',
        'fecha_control',
        'hora_inicio',
        'hora_fin',
        'lugar',
        'ruta'
    ];

    // 🔁 Relaciones
    public function productividades()
    {
        return $this->hasMany(Productividad::class, 'personal_control_id');
    }

    public function rol()
{
    return $this->belongsTo(Rol::class, 'rol_id');
}

 // 🆕 Un personal puede controlar muchos vehículos
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'personal_control_id');
    }

}