<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'clave',
        'ht',
        'hp',
        'creditos',
        'objetivo',
        'carrera',
    ];

    protected $casts = [
        'ht' => 'integer',
        'hp' => 'integer',
        'creditos' => 'integer',
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function unidades()
    {
        return $this->hasMany(Unidad::class);
    }
}
