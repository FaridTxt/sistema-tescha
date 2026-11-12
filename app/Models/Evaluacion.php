<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'evidencia_id',
        'fecha',
        'tipo',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function evidencia()
    {
        return $this->belongsTo(Evidencia::class);
    }
}
