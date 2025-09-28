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

    // public function sugerir(DiagnosticoSugerirRequest $request)
    // {
    //     $response = $this->sugerirDiagnostico->__invoke($request);
    //     return response()->json($response);
    // }

    // public function sugerir(DiagnosticoSugerirRequest $request)
    // {
    //     $url = 'http://127.0.0.1:8001/diagnostico';

    //     $payload = [
    //         'motivo' => $request->input('motivo_consulta'),
    //         'sintomas' => $request->input('sintomas'),
    //     ];

    //     try {
    //         $response = Http::post($url, $payload);

    //         if ($response->successful()) {
    //             $data = $response->json();

    //             return response()->json([
    //                 'diagnostico' => $data['diagnostico'] ?? null,
    //                 'justificacion' => isset($data['razonamiento']) ? [$data['razonamiento']] : [],
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'error' => 'Error en respuesta de FastAPI',
    //                 'status' => $response->status(),
    //                 'body' => $response->body(),
    //             ], 500);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Excepción al llamar FastAPI',
    //             'mensaje' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    public function sugerir(DiagnosticoSugerirRequest $request)
    {
        $validated = $request->validated();

        try {
            $apiUrl = config('services.fastapi.url', 'http://127.0.0.1:8001/diagnostico');

            $response = Http::post($apiUrl, [
                'motivo' => $validated['motivo'],
                'sintomas_1' => $validated['sintomas_1'],
                'sintomas_2' => $validated['sintomas_2'] ?? '',
                'sintomas_3' => $validated['sintomas_3'] ?? '',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return response()->json([
                    'diagnostico' => $data['diagnostico'] ?? 'No disponible',
                    'justificacion' => is_array($data['razonamiento']) ? $data['razonamiento'] : [$data['razonamiento']],
                    'prescripcion' => $data['prescripcion'] ?? '',
                ]);
            }

            return response()->json(['error' => 'Error en la API diagnóstica'], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error de conexión con la API: ' . $e->getMessage()], 500);
        }
    }
}
