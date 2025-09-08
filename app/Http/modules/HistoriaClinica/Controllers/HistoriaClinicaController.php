<?php

namespace App\Http\Modules\HistoriaClinica\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\HistoriaClinica\Requests\HistoriasCreateRequest;
use App\Http\Modules\HistoriaClinica\Requests\HistoriasIndexRequest;
use App\Http\Modules\HistoriaClinica\Requests\HistoriasStoreRequest;
use App\Http\Modules\HistoriaClinica\UseCases\CreateHistoriasUseCase;
use App\Http\Modules\HistoriaClinica\UseCases\ListHistoriasUseCase;
use App\Http\Modules\Pacientes\Requests\PacientesIndexRequest;
use App\Http\Modules\Pacientes\UseCases\ListPacientesUseCase;

class HistoriaClinicaController extends Controller
{
    protected $createHistorias;
    protected $listHistorias;

    public function __construct(ListHistoriasUseCase $listHistorias,  CreateHistoriasUseCase $createHistorias)
    {
        $this->listHistorias = $listHistorias;
        $this->createHistorias = $createHistorias;
    }

    public function index(HistoriasIndexRequest $request)
    {
        $response = $this->listHistorias->__invoke($request);
        $data = $response;
        return view('modules.historias.index', compact('data'));
    }

    public function create(PacientesIndexRequest $request, ListPacientesUseCase $listPacientes)
    {
        // Traer lista de pacientes para mostrar en el select
        $data = $listPacientes($request);
        return view('modules.historias.create', compact('data'));
    }

    public function store(HistoriasStoreRequest $request)
    {
        $response = $this->createHistorias->__invoke($request);
        return redirect()->route('historias.index');
    }

    public function edit()
    {
      
    }

    public function update()
    {
        
    }

    public function show()
    {
        
    }

    public function destroy()
    {
        
    }
}
