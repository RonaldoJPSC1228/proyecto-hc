<?php

namespace App\Http\Modules\Pacientes\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Pacientes\Requests\PacientesCreateRequest;
use App\Http\Modules\Pacientes\Requests\PacientesIndexRequest;
use App\Http\Modules\Pacientes\Requests\PacientesStoreRequest;
use App\Http\Modules\Pacientes\UseCases\CreatePacientesUseCase;
use App\Http\Modules\Pacientes\UseCases\ListPacientesUseCase;
use App\Http\Requests\StorePacienteRequest;
use App\Models\Paciente;
use App\UseCases\Paciente\CreatePaciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    protected $createPacientes;
    protected $listPacientes;

    public function __construct(ListPacientesUseCase $listPacientes,  CreatePacientesUseCase $createPaciente)
    {
        $this->listPacientes = $listPacientes;
        $this->createPacientes = $createPaciente;
    }

    public function index(PacientesIndexRequest $request)
    {
        $response = $this->listPacientes->__invoke($request);
        $data = $response;
        return view('modules.pacientes.index', compact('data'));
    }

    public function create(PacientesCreateRequest $request)
    {
       return view('modules.pacientes.create');
    }

    public function store(PacientesStoreRequest $request)
    {
        $response = $this->createPacientes->__invoke($request);
        return redirect()->route('pacientes.index');
    }

    // public function edit()
    // {
        
    // }

    // public function update()
    // {
  
    // }

    // public function show()
    // {

    // }

    // public function destroy()
    // {

    // }
}
