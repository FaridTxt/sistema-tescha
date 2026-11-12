<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    protected $table = 'versiones';

    protected $fillable = [
        'calendarizacion_id',
        'version',
        'cambios',
    ];

    protected $casts = [
        'version' => 'integer',
        'cambios' => 'array',
    ];

    public function calendarizacion()
    {
        return $this->belongsTo(Calendarizacion::class);
    }
}
