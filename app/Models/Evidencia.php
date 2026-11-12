<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'competencia_id',
        'nombre',
        'porcentaje',
        'indicador',
    ];

    protected $casts = [
        'porcentaje' => 'decimal:2',
    ];

    public function competencia()
    {
        return $this->belongsTo(Competencia::class);
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }
}
