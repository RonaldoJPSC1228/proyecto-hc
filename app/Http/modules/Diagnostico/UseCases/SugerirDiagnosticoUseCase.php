<?php

namespace App\Http\Modules\Diagnostico\UseCases;

use App\Http\Modules\Diagnostico\Requests\DiagnosticoSugerirRequest;

class SugerirDiagnosticoUseCase
{
    public function __invoke(DiagnosticoSugerirRequest $request)
    {
        $sintomas = strtolower($request->input('sintomas'));
        $motivo = strtolower($request->input('motivo_consulta', ''));
        $antecedentes = strtolower($request->input('antecedentes', ''));

        $diagnostico = "No se pudo determinar un diagnóstico claro.";
        $justificacion = [];

        // 🔹 Ejemplo de reglas simples (heurísticas)
        if (str_contains($sintomas, 'tos') && str_contains($sintomas, 'fiebre')) {
            $diagnostico = "Posible infección respiratoria (ej. neumonía)";
            $justificacion[] = "Se detectaron los síntomas: tos + fiebre.";
        }

        if (str_contains($sintomas, 'dolor de cabeza') && str_contains($sintomas, 'mareo')) {
            $diagnostico = "Posible migraña";
            $justificacion[] = "Se detectaron los síntomas: dolor de cabeza + mareo.";
        }

        if (str_contains($antecedentes, 'hipertensión') && str_contains($sintomas, 'dolor en el pecho')) {
            $diagnostico = "Posible angina de pecho";
            $justificacion[] = "Antecedente de hipertensión + síntoma de dolor en el pecho.";
        }

        return [
            'diagnostico' => $diagnostico,
            'justificacion' => $justificacion,
        ];
    }
}
