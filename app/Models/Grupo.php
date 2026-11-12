<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'asignatura_id',
        'periodo_id',
        'docente_id',
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function horario()
    {
        return $this->hasOne(Horario::class);
    }

    public function calendarizaciones()
    {
        return $this->hasMany(Calendarizacion::class);
    }
}
