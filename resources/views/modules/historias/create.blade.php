@extends('layouts.app')

@section('title', 'Registrar Historia Clínica')

@section('content')
<div class="container mt-5 mb-5 p-4 bg-white shadow rounded">
    <h1 class="mb-4 fw-bold text-center">Registrar Historia Clínica</h1>

    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('historias.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Paciente --}}
        <div class="mb-4">
            <label for="paciente_id" class="form-label fw-semibold">Paciente <span class="text-danger">*</span></label>
            <select name="paciente_id" id="paciente_id" class="form-select" required aria-describedby="pacienteHelp">
                <option value="" disabled selected>Seleccione un paciente</option>
                @foreach($data as $paciente)
                <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                    {{ $paciente->nombre }} {{ $paciente->apellido }} - {{ $paciente->documento }}
                </option>
                @endforeach
            </select>
            <div id="pacienteHelp" class="form-text">Selecciona el paciente correspondiente.</div>
        </div>

        {{-- Fecha --}}
        <div class="mb-4">
            <label for="fecha" class="form-label fw-semibold">Fecha <span class="text-danger">*</span></label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required max="{{ date('Y-m-d') }}">
        </div>

        {{-- Motivo de Consulta con botón dictado --}}
        <div class="mb-4">
            <label for="motivo_consulta" class="form-label fw-semibold">Motivo de Consulta <span class="text-danger">*</span></label>
            <div class="input-group">
                <textarea name="motivo_consulta" id="motivo_consulta" class="form-control" rows="3" required>{{ old('motivo_consulta') }}</textarea>
                <button type="button" class="btn btn-outline-primary btn-voice" data-target="motivo_consulta" aria-label="Dictado para Motivo de Consulta">🎤</button>
            </div>
        </div>

        {{-- Antecedentes con botón dictado --}}
        <div class="mb-4">
            <label for="antecedentes" class="form-label fw-semibold">Antecedentes</label>
            <div class="input-group">
                <textarea name="antecedentes" id="antecedentes" class="form-control" rows="3">{{ old('antecedentes') }}</textarea>
                <button type="button" class="btn btn-outline-primary btn-voice" data-target="antecedentes" aria-label="Dictado para Antecedentes">🎤</button>
            </div>
        </div>

        {{-- Síntomas separados --}}
        <div class="mb-4">
            <label for="sintomas_1" class="form-label fw-semibold">Síntoma 1 <span class="text-danger">*</span></label>
            <textarea name="sintomas_1" id="sintomas_1" class="form-control" rows="2" required>{{ old('sintomas_1') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="sintomas_2" class="form-label fw-semibold">Síntoma 2 (opcional)</label>
            <textarea name="sintomas_2" id="sintomas_2" class="form-control" rows="2">{{ old('sintomas_2') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="sintomas_3" class="form-label fw-semibold">Síntoma 3 (opcional)</label>
            <textarea name="sintomas_3" id="sintomas_3" class="form-control" rows="2">{{ old('sintomas_3') }}</textarea>
        </div>

        {{-- Diagnóstico Presuntivo con botón dictado --}}
        <div class="mb-4">
            <label for="diagnostico_presuntivo" class="form-label fw-semibold">Diagnóstico Presuntivo</label>
            <div class="input-group">
                <textarea name="diagnostico_presuntivo" id="diagnostico_presuntivo" class="form-control" rows="3">{{ old('diagnostico_presuntivo') }}</textarea>
                <button type="button" class="btn btn-outline-primary btn-voice" data-target="diagnostico_presuntivo" aria-label="Dictado para Diagnóstico Presuntivo">🎤</button>
            </div>
        </div>

        {{-- Evidencias (archivos) --}}
        <div class="mb-4">
            <label for="evidencias" class="form-label fw-semibold">Evidencias (archivos)</label>
            <input type="file" name="evidencias[]" id="evidencias" class="form-control" multiple aria-describedby="evidenciasHelp" accept="image/*,application/pdf">
            <div id="evidenciasHelp" class="form-text">Puedes subir imágenes, PDFs, etc.</div>
        </div>

        {{-- Botón diagnóstico automático --}}
        <div class="mb-4 d-flex justify-content-start">
            <button type="button" id="btn-diagnostico" class="btn btn-info fw-semibold px-4">
                Generar diagnóstico presuntivo
            </button>
        </div>

        {{-- Resultado diagnóstico --}}
        <div id="resultado-diagnostico" class="alert alert-secondary d-none rounded-3">
            <h5 class="mb-3">Diagnóstico sugerido:</h5>
            <p id="diagnostico-texto" class="mb-3"></p>
            <h6>Justificación:</h6>
            <ul id="justificacion-lista" class="mb-3"></ul>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('historias.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
            <button type="submit" class="btn btn-success fw-semibold px-4">Guardar Historia</button>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
$(function () {
    let recognition;
    if ('webkitSpeechRecognition' in window) {
        recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.lang = "es-ES";
        let targetInput = null;

        $('.btn-voice').on('click', function () {
            targetInput = $('#' + $(this).data('target'));
            recognition.start();
            $(this).addClass('btn-primary').removeClass('btn-outline-primary');
        });

        recognition.onresult = function (event) {
            const transcript = event.results[0][0].transcript;
            if (targetInput) {
                const currentVal = targetInput.val();
                targetInput.val(currentVal ? currentVal.trim() + " " + transcript : transcript);
            }
        };

        recognition.onend = function () {
            $('.btn-voice').removeClass('btn-primary').addClass('btn-outline-primary');
        };

        recognition.onerror = function (event) {
            console.error("Error en reconocimiento de voz:", event.error);
        };
    } else {
        alert("Tu navegador no soporta dictado por voz.");
    }

    $('#btn-diagnostico').on('click', function () {
        $.ajax({
            url: "{{ route('diagnostico.sugerir') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                motivo: $('#motivo_consulta').val(),
                sintomas_1: $('#sintomas_1').val(),
                sintomas_2: $('#sintomas_2').val(),
                sintomas_3: $('#sintomas_3').val(),
            },
            success: function (response) {
                $('#resultado-diagnostico').removeClass('d-none');
                $('#diagnostico-texto').text(response.diagnostico);

                $('#justificacion-lista').empty();
                if (Array.isArray(response.justificacion)) {
                    response.justificacion.forEach(j => {
                        $('#justificacion-lista').append(`<li>${j}</li>`);
                    });
                } else {
                    $('#justificacion-lista').append(`<li>${response.justificacion}</li>`);
                }
            },
            error: function () {
                alert("Error generando diagnóstico.");
            }
        });
    });
});
</script>
@endpush
