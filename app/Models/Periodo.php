<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'semanas',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'semanas' => 'integer',
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function calendarizaciones()
    {
        return $this->hasMany(Calendarizacion::class);
    }
}
