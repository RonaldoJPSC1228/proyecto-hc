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
        'documento',
        'telefono',
        'email',
    ];

    public function historiasClinicas()
    {
        return $this->hasMany(HistoriaClinica::class);
    }
}
