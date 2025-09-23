@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Grabación de Audio con Whisper WASM</h1>

    <div class="mb-3">
        <button id="start" class="btn btn-primary">🎙️ Iniciar</button>
        <button id="stop" class="btn btn-danger" disabled>⏹️ Detener y Enviar</button>
    </div>

    <p id="status">Estado: esperando</p>

    <div class="mt-3">
        <label for="transcription">Transcripción:</label>
        <textarea id="transcription" class="form-control" rows="4" placeholder="Aquí aparecerá el texto..."></textarea>
    </div>
</div>
@endsection

@push('js')
<script>
$(async function () {
    const startBtn = $('#start');
    const stopBtn = $('#stop');
    const status = $('#status');
    const resultEl = $('#transcription');

    let transcriber;
    let isRecording = false;
    let modelLoaded = false;
    let lastText = '';

    startBtn.on('click', async function () {
        if (!transcriber) {
            const WhisperTranscriber = window.WhisperTranscriber?.WhisperTranscriber;
            if (!WhisperTranscriber) {
                alert('No se pudo cargar WhisperTranscriber desde el CDN');
                return;
            }

            transcriber = new WhisperTranscriber({
                modelSize: 'tiny-en-q5_1', // modelo pequeño para rendimiento
                language: 'es',            // idioma español
                useCache: false,
                onTranscription: async (text) => {
                    // Evita mostrar textos repetidos muy cortos (p.ej "you")
                    if (text && text.length > 3 && text !== lastText) {
                        console.log('Texto transcrito:', text);
                        resultEl.val(text);
                        lastText = text;

                        try {
                            await $.ajax({
                                url: '/save-transcription',
                                method: 'POST',
                                contentType: 'application/json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: JSON.stringify({ text }),
                            });
                            console.log('Transcripción guardada');
                        } catch (err) {
                            console.error('Error guardando transcripción', err);
                        }
                    }
                },
                onStatus: (s) => status.text("Estado: " + s),
                onProgress: (p) => status.text(`Procesando... ${Math.round(p * 100)}%`),
                debug: false
            });

            try {
                status.text('Cargando modelo...');
                await transcriber.loadModel();
                modelLoaded = true;
                status.text('Modelo cargado. Listo para grabar');
            } catch (e) {
                console.error('Error al cargar el modelo:', e);
                status.text('Error al cargar el modelo.');
                return;
            }
        }

        if (!modelLoaded) {
            alert('Modelo no cargado todavía, por favor espera.');
            return;
        }

        try {
            await transcriber.startRecording();
            status.text('Grabando...');
            startBtn.prop('disabled', true);
            stopBtn.prop('disabled', false);
            isRecording = true;
            lastText = '';
        } catch (e) {
            console.error('Error al iniciar la grabación:', e);
            status.text('Error al iniciar la grabación.');
        }
    });

    stopBtn.on('click', function () {
        if (transcriber && isRecording) {
            transcriber.stopRecording();
            status.text('Detenido. Procesando...');
            startBtn.prop('disabled', false);
            stopBtn.prop('disabled', true);
            isRecording = false;
        }
    });
});
</script>
@endpush
