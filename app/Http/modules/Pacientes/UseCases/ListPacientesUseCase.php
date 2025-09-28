<?php

namespace App\Http\Modules\Pacientes\UseCases;

use App\Http\Modules\Pacientes\Requests\PacientesIndexRequest;
use App\Models\Paciente;
use App\Models\Role;
use Illuminate\Http\Request;

class ListPacientesUseCase
{
    public $rules = [];
    protected $model = Paciente::class;

    public function __invoke(PacientesIndexRequest $request)
    {
        // Lógica para el caso de uso ListPacientes
        $pacientes = $this->model::orderBy('id', 'desc')->paginate(10);
        return $pacientes;
    }

}
