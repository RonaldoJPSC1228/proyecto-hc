<?php

namespace App\Http\Modules\Transcription\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Paciente};

class TranscriptionCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tabla =  (new Paciente)->getTable();
        return [
            // Definir reglas de validación para el método Create

        ];
    }
}
