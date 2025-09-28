<?php

namespace App\Http\Modules\HistoriaClinica\UseCases;

use App\Http\Modules\HistoriaClinica\Requests\HistoriasIndexRequest;
use App\Models\HistoriaClinica;
use App\Models\Paciente;
use App\Models\Role;
use Illuminate\Http\Request;

class ListHistoriasUseCase
{
    public $rules = [];
    protected $model = HistoriaClinica::class;

    public function __invoke(HistoriasIndexRequest $request)
    {
        // Lógica para el caso de uso ListPacientes
        $historia = $this->model::orderBy('id', 'desc')->paginate(10);
        return $historia;
    }

}
