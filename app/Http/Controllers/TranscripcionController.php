<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranscripcionController extends Controller
{
    public function transcribir(Request $request)
    {
        if (!$request->hasFile('audio')) {
            return response()->json(['error' => 'No se envió audio'], 400);
        }

        $audio = $request->file('audio');

        // 👉 Aquí debes llamar a tu servicio de STT (Whisper, Google, Azure, etc.)
        // Simulamos la respuesta para la demo:
        $texto = "Texto transcrito desde la voz (simulación)";

        return response()->json(['texto' => $texto]);
    }
}
