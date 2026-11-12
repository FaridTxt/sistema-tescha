<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendarizacion_id',
        'nombre',
        'descripcion',
        'estado',
    ];

    public function calendarizacion()
    {
        return $this->belongsTo(Calendarizacion::class);
    }

    public function documentosGenerados()
    {
        return $this->hasMany(DocumentoGenerado::class);
    }
}
