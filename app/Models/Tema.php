<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $fillable = [
        'unidad_id',
        'numero',
        'nombre',
        'padre_id',
        'orden',
    ];

    protected $casts = [
        'orden' => 'integer',
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function padre()
    {
        return $this->belongsTo(Tema::class, 'padre_id');
    }

    public function hijos()
    {
        return $this->hasMany(Tema::class, 'padre_id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
}
