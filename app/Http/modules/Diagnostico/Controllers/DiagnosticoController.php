<?php

namespace App\Http\Modules\Diagnostico\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Diagnostico\Requests\DiagnosticoSugerirRequest;
use App\Http\Modules\Diagnostico\UseCases\SugerirDiagnosticoUseCase;

class DiagnosticoController extends Controller
{
    protected $sugerirDiagnostico;

    public function __construct(SugerirDiagnosticoUseCase $sugerirDiagnostico)
    {
        $this->sugerirDiagnostico = $sugerirDiagnostico;
    }

    public function sugerir(DiagnosticoSugerirRequest $request)
    {
        $response = $this->sugerirDiagnostico->__invoke($request);
        return response()->json($response);
    }
}
