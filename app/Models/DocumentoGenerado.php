<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoGenerado extends Model
{
    use HasFactory;

    protected $table = 'documentos_generados';

    protected $fillable = [
        'escenario_id',
        'tipo',
        'contenido',
        'fecha_generacion',
    ];

    protected $casts = [
        'contenido' => 'array',
        'fecha_generacion' => 'datetime',
    ];

    public function escenario()
    {
        return $this->belongsTo(Escenario::class);
    }
}
