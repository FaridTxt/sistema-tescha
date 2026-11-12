<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'unidad_id',
        'numero',
        'descripcion',
        'horas_teoria',
        'horas_practica',
    ];

    protected $casts = [
        'numero' => 'integer',
        'horas_teoria' => 'integer',
        'horas_practica' => 'integer',
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class);
    }
}
