<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'tema_id',
        'tipo',
        'descripcion',
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }
}
