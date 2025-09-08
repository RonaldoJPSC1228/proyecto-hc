<?php

namespace App\Http\Modules\Diagnostico\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Diagnostico\Requests\DiagnosticoSugerirRequest;
use App\Http\Modules\Diagnostico\UseCases\SugerirDiagnosticoUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    // public function sugerir(Request $request)
    // {
    //     // URL del servicio FastAPI en el puerto 8001
    //     $url = 'http://127.0.0.1:8001/diagnostico';

    //     // Datos a enviar al servicio Python
    //     $payload = [
    //         'motivo' => $request->input('motivo_consulta'),
    //         'sintomas' => $request->input('sintomas'),
    //     ];

    //     // Llamada POST al servicio FastAPI
    //     $response = Http::post($url, $payload);

    //     if ($response->successful()) {
    //         $data = $response->json();

    //         // Devuelve la respuesta que espera el JavaScript en la vista
    //         return response()->json([
    //             'diagnostico' => $data['diagnostico'],
    //             'justificacion' => [$data['razonamiento']], // como lista para mostrar
    //         ]);
    //     }

    //     // Error en la petición al servicio Python
    //     return response()->json(['error' => 'Error generando diagnóstico'], 500);
    // }
}
