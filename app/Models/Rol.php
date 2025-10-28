<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
    ];

    // 🔁 Relación con PersonalControl (un rol puede tener muchos agentes)
    public function personalControls()
    {
        return $this->hasMany(PersonalControl::class, 'rol_id');
    }
}