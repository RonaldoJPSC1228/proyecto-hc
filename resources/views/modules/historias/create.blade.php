@extends('layouts.app')

@section('title', 'Registrar Historia Clínica')

@section('content')
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-8">
        <h1 class="text-2xl font-bold text-center text-blue-800 mb-6">Registrar Historia Clínica</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('historias.store') }}" method="POST" enctype="multipart/form-data" novalidate class="space-y-8">
            @csrf

            {{-- Paciente --}}
            <div>
                <label for="paciente_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Paciente <span class="text-red-600">*</span>
                </label>
                <select id="paciente_id" name="paciente_id" required
                    class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-900 px-4 py-3">
                    <option disabled value="">Seleccione un paciente</option>
                    @foreach ($data as $paciente)
                        <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                            {{ $paciente->nombre }} {{ $paciente->apellido }} - {{ $paciente->documento }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Seleccione el paciente correspondiente.</p>
            </div>

            {{-- Fecha --}}
            <div>
                <label for="fecha" class="block text-sm font-semibold text-gray-700 mb-2">
                    Fecha <span class="text-red-600">*</span>
                </label>
                <input type="date" id="fecha" name="fecha" max="{{ date('Y-m-d') }}" required
                    value="{{ old('fecha', date('Y-m-d')) }}"
                    class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent px-4 py-3 text-gray-900" />
            </div>

            {{-- Motivo de Consulta --}}
            <div>
                <label for="motivo_consulta" class="block text-sm font-semibold text-gray-700 mb-2">
                    Motivo de Consulta <span class="text-red-600">*</span>
                </label>
                <div
                    class="flex rounded-lg border border-gray-300 shadow-sm focus-within:ring-2 focus-within:ring-blue-600 overflow-hidden">
                    <textarea id="motivo_consulta" name="motivo_consulta" rows="4" required
                        class="flex-grow p-4 resize-y text-gray-900 placeholder-gray-400 focus:outline-none">{{ old('motivo_consulta') }}</textarea>
                    <button type="button" data-target="motivo_consulta"
                        class="btn-voice bg-blue-600 hover:bg-blue-700 text-white px-5 font-semibold focus:ring-2 focus:ring-blue-500 transition">
                        🎤
                    </button>
                </div>
            </div>

            {{-- Antecedentes --}}
            <div>
                <label for="antecedentes" class="block text-sm font-semibold text-gray-700 mb-2">Antecedentes</label>
                <div
                    class="flex rounded-lg border border-gray-300 shadow-sm focus-within:ring-2 focus-within:ring-blue-600 overflow-hidden">
                    <textarea id="antecedentes" name="antecedentes" rows="4"
                        class="flex-grow p-4 resize-y text-gray-900 placeholder-gray-400 focus:outline-none">{{ old('antecedentes') }}</textarea>
                    <button type="button" data-target="antecedentes"
                        class="btn-voice bg-blue-600 hover:bg-blue-700 text-white px-5 font-semibold focus:ring-2 focus:ring-blue-500 transition">
                        🎤
                    </button>
                </div>
            </div>

            {{-- Síntomas --}}
            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="sintomas_1" class="block text-sm font-semibold text-gray-700 mb-2">
                        Síntoma 1 <span class="text-red-600">*</span>
                    </label>
                    <textarea id="sintomas_1" name="sintoma_1" rows="2" required
                        class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-600 text-gray-900 resize-y">{{ old('sintomas_1') }}</textarea>
                </div>
                <div>
                    <label for="sintomas_2" class="block text-sm font-semibold text-gray-700 mb-2">Síntoma 2
                        (Opcional)</label>
                    <textarea id="sintomas_2" name="sintoma_2" rows="2"
                        class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-600 text-gray-900 resize-y">{{ old('sintomas_2') }}</textarea>
                </div>
                <div>
                    <label for="sintomas_3" class="block text-sm font-semibold text-gray-700 mb-2">Síntoma 3
                        (Opcional)</label>
                    <textarea id="sintomas_3" name="sintoma_3" rows="2"
                        class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-600 text-gray-900 resize-y">{{ old('sintomas_3') }}</textarea>
                </div>
            </div>

            {{-- Diagnóstico Presuntivo --}}
            <div>
                <label for="diagnostico_presuntivo" class="block text-sm font-semibold text-gray-700 mb-2">Diagnóstico
                    Presuntivo</label>
                <div
                    class="flex rounded-lg border border-gray-300 shadow-sm focus-within:ring-2 focus-within:ring-blue-600 overflow-hidden">
                    <textarea id="diagnostico_presuntivo" name="diagnostico_presuntivo" rows="4"
                        class="flex-grow p-4 resize-y text-gray-900 placeholder-gray-400 focus:outline-none">{{ old('diagnostico_presuntivo') }}</textarea>
                    <button type="button" data-target="diagnostico_presuntivo"
                        class="btn-voice bg-blue-600 hover:bg-blue-700 text-white px-5 font-semibold focus:ring-2 focus:ring-blue-500 transition">
                        🎤
                    </button>
                </div>
            </div>

            {{-- Evidencias --}}
            <div>
                <label for="evidencias" class="block text-sm font-semibold text-gray-700 mb-2">Evidencias (Archivos)</label>
                <input type="file" id="evidencias" name="evidencias" accept="image/*,application/pdf"
                    class="w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:ring-2 focus:ring-blue-600" />
                <p class="text-xs text-gray-500 mt-1">Puede subir imágenes o documentos PDF como evidencias.</p>
            </div>

            {{-- Botón Generar Diagnóstico --}}
            <div>
                <button type="button" id="btn-diagnostico"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-lg shadow-lg transition duration-200">
                    Generar diagnóstico presuntivo
                </button>
            </div>

            {{-- Resultado Diagnóstico --}}
            <div id="resultado-diagnostico" class="hidden bg-gray-50 rounded-lg border border-gray-300 p-6 mt-6 shadow">
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Diagnóstico sugerido:</h3>
                <p id="diagnostico-texto" class="mb-4 text-gray-700"></p>
                <h4 class="font-semibold mb-2 text-gray-700">Justificación:</h4>
                <ul id="justificacion-lista" class="list-disc list-inside text-gray-700 space-y-1"></ul>
            </div>

            {{-- Botones --}}
            <div class="flex justify-between mt-10">
                <a href="{{ route('historias.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-lg font-medium shadow transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition">
                    Guardar Historia
                </button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnDictado = document.querySelectorAll('.btn-voice');
            const status = document.createElement('div');
            status.classList.add('text-gray-500', 'italic', 'mt-2', 'text-center');
            document.querySelector('form').prepend(status);

            btnDictado.forEach(button => {
                let recognition;
                let listening = false;

                button.addEventListener('click', () => {
                    const targetId = button.getAttribute('data-target');
                    const campo = document.getElementById(targetId);

                    const SpeechRecognition = window.SpeechRecognition || window
                        .webkitSpeechRecognition;
                    if (!SpeechRecognition) {
                        status.textContent = 'Dictado no soportado en este navegador';
                        btn.disabled = true;
                        return;
                    }

                    if (!recognition) {
                        recognition = new SpeechRecognition();
                        recognition.lang = 'es-ES';
                        recognition.interimResults = true;
                        recognition.continuous = false;

                        recognition.onresult = (event) => {
                            let finalTrans = '';
                            let interimTrans = '';

                            for (let i = event.resultIndex; i < event.results.length; i++) {
                                if (event.results[i].isFinal) {
                                    finalTrans += event.results[i][0].transcript;
                                } else {
                                    interimTrans += event.results[i][0].transcript;
                                }
                            }

                            if (interimTrans) {
                                status.textContent = '';
                            }
                            if (finalTrans && campo) {
                                campo.value += (campo.value ? ' ' : '') + finalTrans;
                                status.textContent = '';
                            }
                        };

                        recognition.onerror = (event) => {
                            status.textContent = 'Error: ' + event.error;
                            button.textContent = '🎤';
                            listening = false;
                        };

                        recognition.onend = () => {
                            button.textContent = '🎤';
                            listening = false;
                            status.textContent = '';
                        };
                    }

                    if (!listening) {
                        recognition.start();
                        listening = true;
                        button.textContent = '';
                        status.textContent = '';
                    } else {
                        recognition.stop();
                        listening = false;
                        button.textContent = '🎤';
                    }
                });
            });

            // Botón diagnóstico
            const btnDiagnostico = document.getElementById('btn-diagnostico');
            btnDiagnostico?.addEventListener('click', () => {
                const data = {
                    _token: '{{ csrf_token() }}',
                    motivo: document.getElementById('motivo_consulta').value,
                    sintomas_1: document.getElementById('sintomas_1').value,
                    sintomas_2: document.getElementById('sintomas_2').value,
                    sintomas_3: document.getElementById('sintomas_3').value,
                };

                fetch('{{ route('diagnostico.sugerir') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': data._token
                        },
                        body: JSON.stringify(data),
                    })
                    .then(resp => resp.json())
                    .then(response => {
                        document.getElementById('resultado-diagnostico').classList.remove('hidden');
                        document.getElementById('diagnostico-texto').textContent = response
                            .diagnostico || '';
                        const lista = document.getElementById('justificacion-lista');
                        lista.innerHTML = '';
                        if (Array.isArray(response.justificacion)) {
                            response.justificacion.forEach(j => {
                                const li = document.createElement('li');
                                li.textContent = j;
                                lista.appendChild(li);
                            });
                        } else if (response.justificacion) {
                            const li = document.createElement('li');
                            li.textContent = response.justificacion;
                            lista.appendChild(li);
                        }
                    })
                    .catch(() => alert('Error generando diagnóstico.'));
            });
        });
    </script>
@endpush
