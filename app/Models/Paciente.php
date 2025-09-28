<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'genero',
        'email',
        'telefono',
        'tipo_identificacion',
        'numero_identificacion',
        'direccion',
        'pais',
        'departamento',
        'ciudad',
        'tipo_afiliacion',
        'num_historial_medico',
        'eps',
        'ocupacion',
        'discapacidad',
        'subsidiaria'
    ];

    public function historiasClinicas()
    {
        return $this->hasMany(HistoriaClinica::class);
    }
}
