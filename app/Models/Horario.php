<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'dia',
        'hora_inicio',
        'hora_fin',
        'duracion_horas',
        'salon',
        'edificio',
    ];

    protected $casts = [
        'duracion_horas' => 'integer',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}
