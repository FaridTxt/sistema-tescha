<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendarizacion extends Model
{
    use HasFactory;

    protected $table = 'calendarizaciones';

    protected $fillable = [
        'periodo_id',
        'grupo_id',
        'estado',
        'fecha_creacion',
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function escenarios()
    {
        return $this->hasMany(Escenario::class);
    }

    public function versiones()
    {
        return $this->hasMany(Version::class);
    }
}
