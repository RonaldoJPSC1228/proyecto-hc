<?php

namespace App\Http\Modules\Transcription\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Paciente};
use Illuminate\Validation\Rules\Password;

class TranscriptionUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tabla =  (new Paciente)->getTable();
        return [
            // Definir reglas de validación para el método Update
        // 'id' => 'nullable|numeric|exists:'.$tabla.',id',
        // 'first_name' => 'nullable',
        // 'last_name' => 'nullable',
        // 'email' => ['nullable','email','max:255'],
        // 'nickname' => ['nullable'],
        // 'document_type' => 'nullable|exists:parameter_values,id',
        // 'identification' => 'nullable|numeric',
        // 'rol_id' => 'nullable|numeric|exists:permission_roles,id',
        // 'profile_id' => 'nullable|numeric',
        // 'password' => ['nullable','confirmed', Password::min(8)],
        // 'phone' => 'nullable',
        // 'avatar' => 'nullable|nullable|file|image|mimes:jpg,jpeg,png|max:2048',

        ];
    }
}
