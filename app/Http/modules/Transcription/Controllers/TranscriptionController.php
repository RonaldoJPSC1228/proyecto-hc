<?php

namespace App\Http\Modules\Transcription\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class TranscriptionController extends Controller
{
    // public function transcribe(Request $request)
    // {
    //     $request->validate([
    //         'audio' => 'required|file|mimes:webm,wav,mp3,ogg',
    //     ]);

    //     $file = $request->file('audio');

    //     try {
    //         // 1️⃣  Subir a AssemblyAI como stream binario
    //         $uploadResponse = Http::withHeaders([
    //             'authorization' => config('services.assemblyai.key'),
    //             'content-type'  => 'application/octet-stream', // clave para WebM/Opus
    //         ])->send('POST', 'https://api.assemblyai.com/v2/upload', [
    //             'body' => fopen($file->getRealPath(), 'r'),
    //         ]);

    //         if ($uploadResponse->failed()) {
    //             return response()->json([
    //                 'error'   => 'Error al subir audio a AssemblyAI',
    //                 'details' => $uploadResponse->body(),
    //             ], 500);
    //         }

    //         $uploadUrl = $uploadResponse->json()['upload_url'] ?? null;
    //         if (!$uploadUrl) {
    //             return response()->json([
    //                 'error'   => 'No se obtuvo upload_url de AssemblyAI',
    //                 'details' => $uploadResponse->body(),
    //             ], 500);
    //         }

    //         // 2️⃣  Crear transcripción
    //         $transcribeResponse = Http::withHeaders([
    //             'authorization' => config('services.assemblyai.key'),
    //         ])->post('https://api.assemblyai.com/v2/transcript', [
    //             'audio_url' => $uploadUrl,
    //             'language_detection' => true,
    //         ]);

    //         if ($transcribeResponse->failed()) {
    //             return response()->json([
    //                 'error'   => 'Error al crear transcripción en AssemblyAI',
    //                 'details' => $transcribeResponse->body(),
    //             ], 500);
    //         }

    //         return response()->json($transcribeResponse->json());

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Excepción: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // public function status($id)
    // {
    //     try {
    //         $response = Http::withHeaders([
    //             'authorization' => config('services.assemblyai.key'),
    //         ])->get("https://api.assemblyai.com/v2/transcript/{$id}");

    //         return $response->json();
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Excepción: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }


    public function saveTranscription(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        // Guardar texto transcrito en BD o procesar como necesites
        // Ejemplo:
        // Transcription::create(['content' => $request->text]);

        return response()->json(['message' => 'Transcripción guardada']);
    }
}
