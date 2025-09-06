<?php

namespace App\Http\Modules\Pacientes\UseCases;

use App\Http\Modules\Pacientes\Requests\PacientesStoreRequest;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;

class CreatePacientesUseCase
{
    public $rules = [];
    protected $model = Paciente::class;

    public function __invoke(PacientesStoreRequest $request)
    {
        // Lógica para el caso de uso CreatePacientes
        $data = $request->validated();
        $paciente = new Paciente($data);
        // $paciente->nombre = $request->input('nombre');
        // $paciente->apellido = $request->input('apellido');
        // $paciente->fecha_nacimiento = $request->input('fecha_nacimiento');
        // $paciente->genero = $request->input('genero');
        // $paciente->documento = $request->input('documento');
        // $paciente->telefono = $request->input('telefono');
        // $paciente->email = $request->input('email');
        $paciente->save();

        return $paciente;
    }
}
