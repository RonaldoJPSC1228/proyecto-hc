@extends('layouts.app')

@section('title', 'Registrar Historia Clínica')

@section('content')
<div class="container">
    <h1 class="mb-4">Registrar Historia Clínica</h1>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('historias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Paciente --}}
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-select" required>
                <option value="">Seleccione un paciente</option>
                @foreach($data as $paciente)
                    <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellido }} - {{ $paciente->documento }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha --}}
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control"
                   value="{{ old('fecha', date('Y-m-d')) }}" required>
        </div>

        {{-- Motivo de consulta --}}
        <div class="mb-3">
            <label for="motivo_consulta" class="form-label">Motivo de Consulta</label>
            <div class="input-group">
                <textarea name="motivo_consulta" id="motivo_consulta" class="form-control" rows="3" required>{{ old('motivo_consulta') }}</textarea>
                <button type="button" class="btn btn-outline-primary btn-voz" data-target="motivo_consulta">🎤</button>
            </div>
        </div>

        {{-- Antecedentes --}}
        <div class="mb-3">
            <label for="antecedentes" class="form-label">Antecedentes</label>
            <div class="input-group">
                <textarea name="antecedentes" id="antecedentes" class="form-control" rows="3">{{ old('antecedentes') }}</textarea>
                <button type="button" class="btn btn-outline-primary btn-voz" data-target="antecedentes">🎤</button>
            </div>
        </div>

        {{-- Síntomas --}}
        <div class="mb-3">
            <label for="sintomas" class="form-label">Síntomas</label>
            <div class="input-group">
                <textarea name="sintomas" id="sintomas" class="form-control" rows="3" required>{{ old('sintomas') }}</textarea>
                <button type="button" class="btn btn-outline-primary btn-voz" data-target="sintomas">🎤</button>
            </div>
        </div>

        {{-- Diagnóstico presuntivo --}}
        <div class="mb-3">
            <label for="diagnostico_presuntivo" class="form-label">Diagnóstico Presuntivo</label>
            <div class="input-group">
                <textarea name="diagnostico_presuntivo" id="diagnostico_presuntivo" class="form-control" rows="3">{{ old('diagnostico_presuntivo') }}</textarea>
                <button type="button" class="btn btn-outline-primary btn-voz" data-target="diagnostico_presuntivo">🎤</button>
            </div>
        </div>
        

        {{-- Evidencias --}}
        <div class="mb-3">
            <label for="evidencias" class="form-label">Evidencias (archivos)</label>
            <input type="file" name="evidencias[]" class="form-control" multiple>
            <small class="text-muted">Puedes subir imágenes, PDFs, etc.</small>
        </div>

        {{-- Diagnóstico automático --}}
        <div class="mb-3">
            <button type="button" id="btn-diagnostico" class="btn btn-info">
                Generar diagnóstico presuntivo
            </button>
        </div>

        <div id="resultado-diagnostico" class="alert alert-secondary d-none">
            <h5>Diagnóstico sugerido:</h5>
            <p id="diagnostico-texto"></p>
            <h6>Justificación:</h6>
            <ul id="justificacion-lista"></ul>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('historias.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar Historia</button>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
$(document).ready(function () {
    let recognition;
    if ('webkitSpeechRecognition' in window) {
        recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.lang = "es-ES";

        let targetInput = null;

        $('.btn-voz').on('click', function () {
            targetInput = $('#' + $(this).data('target'));
            recognition.start();

            // Botón azul mientras graba
            $(this).addClass('btn-primary').removeClass('btn-outline-primary');
        });

        recognition.onresult = function (event) {
            let transcript = event.results[0][0].transcript;
            if (targetInput) {
                targetInput.val(targetInput.val() + " " + transcript);
            }
        };

        recognition.onend = function () {
            $('.btn-voz').removeClass('btn-primary').addClass('btn-outline-primary');
        };

        recognition.onerror = function (event) {
            console.error("Error en reconocimiento de voz:", event.error);
        };
    } else {
        alert("Tu navegador no soporta dictado por voz.");
    }

    // 🔹 Botón de diagnóstico automático
    $('#btn-diagnostico').on('click', function () {
        $.ajax({
            url: "{{ route('diagnostico.sugerir') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                motivo_consulta: $('#motivo_consulta').val(),
                antecedentes: $('#antecedentes').val(),
                sintomas: $('#sintomas').val(),
            },
            success: function (response) {
                $('#resultado-diagnostico').removeClass('d-none');
                $('#diagnostico-texto').text(response.diagnostico);

                let lista = $('#justificacion-lista');
                lista.empty();
                response.justificacion.forEach(j => {
                    lista.append(`<li>${j}</li>`);
                });
            },
            error: function () {
                alert("Error generando diagnóstico.");
            }
        });
    });
});
</script>
@endpush
