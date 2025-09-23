@extends('layouts.app')

@section('title', 'Crear Paciente')

@section('content')
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-8">
        <h1 class="text-2xl font-bold text-center text-blue-800 mb-6">Registrar Nuevo Paciente</h1>

        {{-- Errores --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pacientes.store') }}" method="POST" autocomplete="off" novalidate class="space-y-6">
            @csrf

            <!-- Nombre y Apellido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required placeholder="Ingrese el nombre">
                </div>
                <div>
                    <label for="apellido" class="block text-sm font-semibold text-gray-700">Apellido <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required placeholder="Ingrese el apellido">
                </div>
            </div>

            <!-- Fecha de nacimiento, Género, Email -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="fecha_nacimiento" class="block text-sm font-semibold text-gray-700">Fecha de nacimiento
                        <span class="text-red-500">*</span></label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                        value="{{ old('fecha_nacimiento') }}" max="{{ date('Y-m-d') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="genero" class="block text-sm font-semibold text-gray-700">Género <span
                            class="text-red-500">*</span></label>
                    <select id="genero" name="genero"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="" disabled selected>Seleccione</option>
                        <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="otro" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">Correo Electrónico <span
                            class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required placeholder="ejemplo@correo.com">
                </div>
            </div>

            <!-- Teléfono, Tipo y Número de Identificación -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="telefono" class="block text-sm font-semibold text-gray-700">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="+57 300 1234567">
                </div>
                <div>
                    <label for="tipo_identificacion" class="block text-sm font-semibold text-gray-700">Tipo de
                        Identificación <span class="text-red-500">*</span></label>
                    <select id="tipo_identificacion" name="tipo_identificacion"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="" disabled selected>Seleccione</option>
                        <option value="cedula" {{ old('tipo_identificacion') == 'cedula' ? 'selected' : '' }}>Cédula
                        </option>
                        <option value="tarjeta_identidad"
                            {{ old('tipo_identificacion') == 'tarjeta_identidad' ? 'selected' : '' }}>Tarjeta de identidad
                        </option>
                        <option value="nit" {{ old('tipo_identificacion') == 'nit' ? 'selected' : '' }}>NIT</option>
                        <option value="cedula_extranjeria"
                            {{ old('tipo_identificacion') == 'cedula_extranjeria' ? 'selected' : '' }}>Cédula de
                            extranjería</option>
                    </select>
                </div>
                <div>
                    <label for="numero_identificacion" class="block text-sm font-semibold text-gray-700">Número de
                        Identificación <span class="text-red-500">*</span></label>
                    <input type="number" id="numero_identificacion" name="numero_identificacion"
                        value="{{ old('numero_identificacion') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required placeholder="Ingrese el número">
                </div>
            </div>

            <!-- Dirección, País -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="direccion" class="block text-sm font-semibold text-gray-700">Dirección</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Calle 123 #45-67">
                </div>
                <div>
                    <label for="pais" class="block text-sm font-semibold text-gray-700">País</label>
                    <input type="text" id="pais" name="pais" value="{{ old('pais') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Colombia">
                </div>
            </div>

            <!-- Departamento y Ciudad -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="departamento" class="block text-sm font-semibold text-gray-700">Departamento</label>
                    <input type="text" id="departamento" name="departamento" value="{{ old('departamento') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Atlántico">
                </div>
                <div>
                    <label for="ciudad" class="block text-sm font-semibold text-gray-700">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Barranquilla">
                </div>
            </div>

            <!-- EPS, Ocupación, Afiliación, Historial -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tipo_afiliacion" class="block text-sm font-semibold text-gray-700">Tipo de
                        afiliación</label>
                    <input type="text" id="tipo_afiliacion" name="tipo_afiliacion"
                        value="{{ old('tipo_afiliacion') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Contributiva">
                </div>
                <div>
                    <label for="num_historial_medico" class="block text-sm font-semibold text-gray-700">Número historial
                        médico</label>
                    <input type="number" id="num_historial_medico" name="num_historial_medico"
                        value="{{ old('num_historial_medico') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: 123456789">
                </div>
            </div>

            <!-- EPS y Ocupación -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="eps" class="block text-sm font-semibold text-gray-700">EPS</label>
                    <input type="text" id="eps" name="eps" value="{{ old('eps') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nombre de la EPS">
                </div>
                <div>
                    <label for="ocupacion" class="block text-sm font-semibold text-gray-700">Ocupación</label>
                    <input type="text" id="ocupacion" name="ocupacion" value="{{ old('ocupacion') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Ingeniero">
                </div>
            </div>

            <!-- Discapacidad y Subsidiaria -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="discapacidad" class="block text-sm font-semibold text-gray-700">Discapacidad</label>
                    <input type="text" id="discapacidad" name="discapacidad" value="{{ old('discapacidad') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ej: Ninguna">
                </div>
                <div>
                    <label for="subsidiaria" class="block text-sm font-semibold text-gray-700">Subsidiaria</label>
                    <input type="text" id="subsidiaria" name="subsidiaria" value="{{ old('subsidiaria') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus-border-blue-500"
                        placeholder="Ej: Nombre de subsidiaria">
                </div>
            </div>

            <!-- Dictado inteligente -->
            <div class="flex items-center gap-4 my-4">
                <button type="button" id="dictadoBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    Dictado Inteligente
                </button>
                <span id="dictadoStatus" class="italic text-gray-500"></span>
            </div>

            <!-- Botones -->
            <div class="flex justify-between">
                <a href="{{ route('pacientes.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('dictadoBtn');
            const status = document.getElementById('dictadoStatus');

            const campos = {
                nombre: document.getElementById('nombre'),
                apellido: document.getElementById('apellido'),
                fecha_nacimiento: document.getElementById('fecha_nacimiento'),
                genero: document.getElementById('genero'),
                email: document.getElementById('email'),
                telefono: document.getElementById('telefono'),
                tipo_identificacion: document.getElementById('tipo_identificacion'),
                numero_identificacion: document.getElementById('numero_identificacion'),
                direccion: document.getElementById('direccion'),
                pais: document.getElementById('pais'),
                departamento: document.getElementById('departamento'),
                ciudad: document.getElementById('ciudad'),
                tipo_afiliacion: document.getElementById('tipo_afiliacion'),
                num_historial_medico: document.getElementById('num_historial_medico'),
                eps: document.getElementById('eps'),
                ocupacion: document.getElementById('ocupacion'),
                discapacidad: document.getElementById('discapacidad'),
                subsidiaria: document.getElementById('subsidiaria')
            };

            const tipoIdentificacionMap = {
                'cedula': 'cedula',
                'cédula': 'cedula',
                'cédula de ciudadanía': 'cedula',
                'cedula de ciudadania': 'cedula',
                'tarjeta de identidad': 'tarjeta_identidad',
                'nit': 'nit',
                'cédula extranjería': 'cedula_extranjeria',
                'cedula extranjeria': 'cedula_extranjeria',
                'extranjeria': 'cedula_extranjeria'
            };

            function parseFechaNatural(text) {
                const meses = {
                    enero: '01',
                    febrero: '02',
                    marzo: '03',
                    abril: '04',
                    mayo: '05',
                    junio: '06',
                    julio: '07',
                    agosto: '08',
                    septiembre: '09',
                    octubre: '10',
                    noviembre: '11',
                    diciembre: '12'
                };
                const regex = /(\d{1,2}) de ([a-z]+) (?:del )?(\d{4})/i;
                const match = text.match(regex);
                if (!match) return null;
                const dia = match[1].padStart(2, '0');
                const mes = meses[match[2].toLowerCase()];
                const ano = match[3];
                if (!mes) return null;
                return `${ano}-${mes}-${dia}`;
            }

            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                status.textContent = 'Dictado no soportado en este navegador';
                btn.disabled = true;
                return;
            }

            const recognition = new SpeechRecognition();
            recognition.lang = 'es-ES';
            recognition.continuous = true;
            recognition.interimResults = true;

            let listening = false;

            btn.addEventListener('click', () => {
                if (!listening) {
                    recognition.start();
                    listening = true;
                    btn.textContent = 'Detener Dictado';
                    status.textContent = 'Escuchando...';
                } else {
                    recognition.stop();
                    listening = false;
                    btn.textContent = 'Dictado Inteligente';
                    status.textContent = 'Dictado detenido';
                }
            });

            recognition.onresult = (event) => {
                let interimTranscript = '';
                let finalTranscript = '';

                for (let i = event.resultIndex; i < event.results.length; i++) {
                    if (event.results[i].isFinal) {
                        finalTranscript += event.results[i][0].transcript;
                    } else {
                        interimTranscript += event.results[i][0].transcript;
                    }
                }

                if (interimTranscript) {
                    status.textContent = 'Escuchando: ' + interimTranscript;
                }
                if (finalTranscript) {
                    status.textContent = 'Transcripción final: ' + finalTranscript;

                    const transcript = finalTranscript.toLowerCase();

                    // Tipo de identificación - búsqueda flexible
                    const matchTipoId = transcript.match(/tipo de identificaci[oó]n(?: es)? ([\w\s]+)/i);
                    if (matchTipoId && campos.tipo_identificacion) {
                        const palabraClave = matchTipoId[1].toLowerCase().trim();
                        let valorSeleccionado = '';
                        for (const clave in tipoIdentificacionMap) {
                            if (palabraClave.split(' ').some(palabra => clave.includes(palabra))) {
                                valorSeleccionado = tipoIdentificacionMap[clave];
                                break;
                            }
                        }
                        if (valorSeleccionado) {
                            campos.tipo_identificacion.value = valorSeleccionado;
                        }
                    }

                    // Fecha de nacimiento en formato natural
                    const matchFechaNatural = transcript.match(/fecha de nacimiento(?: es)? ([\w\s\d]+)/i);
                    if (matchFechaNatural) {
                        const fechaParseada = parseFechaNatural(matchFechaNatural[1]);
                        if (fechaParseada && campos.fecha_nacimiento) {
                            campos.fecha_nacimiento.value = fechaParseada;
                        }
                    }

                    // Otros campos con expresiones regulares
                    const regexMap = {
                        nombre: /nombre(?: es)? ([a-záéíóúñ\s]+)/i,
                        apellido: /apellido(?: es)? ([a-záéíóúñ\s]+)/i,
                        genero: /género(?: es)? (male|female|other|masculino|femenino|otro)/i,
                        email: /correo (?:electr[oó]nico|email)(?: es)? ([\w.-]+@[\w.-]+\.\w+)/i,
                        telefono: /tel[eé]fono(?: es)? ([\d\s+-]+)/i,
                        numero_identificacion: /n[úu]mero de identificaci[oó]n(?: es)? ([\w\d]+)/i,
                        direccion: /direcci[oó]n(?: es)? ([\w\d\s\.,/-]+)/i,
                        pais: /pa[ií]s(?: es)? ([\w\s]+)/i,
                        departamento: /departamento(?: es)? ([\w\s]+)/i,
                        ciudad: /ciudad(?: es)? ([\w\s]+)/i,
                        tipo_afiliacion: /tipo de afiliaci[oó]n(?: es)? ([\w\s]+)/i,
                        num_historial_medico: /num(?:ero|\.?) historial m[eé]dico(?: es)? ([\w\d]+)/i,
                        eps: /eps(?: es)? ([\w\s]+)/i,
                        ocupacion: /ocupaci[oó]n(?: es)? ([\w\s]+)/i,
                        discapacidad: /discapacidad(?: es)? ([\w\s]+)/i,
                        subsidiaria: /subsidiaria(?: es)? ([\w\s]+)/i
                    };

                    for (const campo in regexMap) {
                        const match = transcript.match(regexMap[campo]);
                        if (match && campos[campo]) {
                            campos[campo].value = match[1].trim();
                        }
                    }
                }
            };

            recognition.onerror = (event) => {
                status.textContent = 'Error: ' + event.error;
                btn.textContent = 'Dictado Inteligente';
                listening = false;
            };

            recognition.onend = () => {
                if (listening) {
                    recognition.start();
                }
            };
        });
    </script>
@endsection
