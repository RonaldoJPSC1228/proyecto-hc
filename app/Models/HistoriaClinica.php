<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'fecha',
        'motivo_consulta',
        'antecedentes',
        'sintoma_1',
        'sintoma_2',
        'sintoma_3',
        'diagnostico_presuntivo',
        'evidencias',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
