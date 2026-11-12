<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioEscolar extends Model
{
    use HasFactory;

    protected $table = 'calendarios_escolares';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'feriados',
        'vacaciones',
        'suspensiones',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'feriados' => 'array',
        'vacaciones' => 'array',
        'suspensiones' => 'array',
    ];
}
