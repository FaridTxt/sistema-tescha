<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';

    protected $fillable = [
        'asignatura_id',
        'numero',
        'nombre',
        'horas_teoria',
        'horas_practica',
    ];

    protected $casts = [
        'numero' => 'integer',
        'horas_teoria' => 'integer',
        'horas_practica' => 'integer',
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function competencias()
    {
        return $this->hasMany(Competencia::class);
    }

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }
}
