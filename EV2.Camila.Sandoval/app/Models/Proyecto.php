<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',         // Nombre del proyecto
        'fecha_inicio',   // Fecha de inicio
        'estado',         // Estado del proyecto
        'responsable',    // Responsable del proyecto
        'monto',          // Monto del proyecto
        'creado_por',     // ID del usuario que crea el proyecto
    ];

    // Relación con el modelo de usuario (usuario que creó el proyecto)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }
}
