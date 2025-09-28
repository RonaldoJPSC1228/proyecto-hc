@extends('layouts.app')

@section('title', 'Listado de Historias Clínicas')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-blue-800">Listado de Historias Clínicas</h2>
            <a href="{{ route('historias.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                <i data-feather="file-plus"></i>
                Nueva Historia Clínica
            </a>
        </div>

        <!-- Alerta de éxito -->
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-100 text-green-800 px-4 py-3 rounded-lg shadow">
                <i data-feather="check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tabla -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-4 py-3 font-semibold">
                Historias Clínicas Registradas
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 text-center">#</th>
                            <th class="px-4 py-3 text-left">Paciente</th>
                            <th class="px-4 py-3 text-left">Fecha</th>
                            <th class="px-4 py-3 text-left">Motivo</th>
                            <th class="px-4 py-3 text-left">Antecedentes</th>
                            <th class="px-4 py-3 text-left">Síntomas</th>
                            <th class="px-4 py-3 text-left">Diagnóstico</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($data as $historia)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3 text-center font-medium text-gray-700">{{ $historia->id }}</td>
                                <td class="px-4 py-3">
                                    @if ($historia->paciente)
                                        <span class="font-semibold text-gray-800">
                                            {{ $historia->paciente->nombre }} {{ $historia->paciente->apellido }}
                                        </span>
                                    @else
                                        <span class="italic text-gray-500">Paciente no disponible</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ \Carbon\Carbon::parse($historia->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 truncate max-w-[160px]" title="{{ $historia->motivo_consulta }}">
                                    {{ Str::limit($historia->motivo_consulta, 40) }}
                                </td>
                                <td class="px-4 py-3 truncate max-w-[160px]" title="{{ $historia->antecedentes }}">
                                    {{ Str::limit($historia->antecedentes, 40) }}
                                </td>
                                <td class="px-4 py-3 truncate max-w-[160px]"
                                    title="{{ $historia->sintoma_1 }} {{ $historia->sintoma_2 }} {{ $historia->sintoma_3 }}">
                                    {{ Str::limit($historia->sintoma_1 . ' ' . $historia->sintoma_2 . ' ' . $historia->sintoma_3, 40) }}
                                </td>
                                <td class="px-4 py-3 truncate max-w-[160px]"
                                    title="{{ $historia->diagnostico_presuntivo }}">
                                    {{ Str::limit($historia->diagnostico_presuntivo, 40) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center italic text-gray-500">
                                    No hay historias clínicas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($data->hasPages())
                <div class="px-4 py-3 bg-gray-50 border-t">
                    {{ $data->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
@endsection
