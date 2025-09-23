<?php

namespace App\Http\Modules\Transcription\UseCases;

use App\Http\Modules\Pacientes\Requests\TranscriptionIndexRequest;
use App\Models\Paciente;
use App\Models\Role;
use Illuminate\Http\Request;

class ListTranscriptionUseCase
{
    public $rules = [];
    protected $model = Paciente::class;

    public function __invoke(TranscriptionIndexRequest $request)
    {
        // Lógica para el caso de uso ListPacientes
        $pacientes = $this->model::all();
        return $pacientes;
    }

}
