@extends('layouts.app')

@section('title', 'Listado de Pacientes')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-blue-800">Listado de Pacientes</h2>
        <a href="{{ route('pacientes.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
            <i data-feather="user-plus"></i>
            Nuevo Paciente
        </a>
    </div>

    <!-- Alertas -->
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-100 text-green-800 px-4 py-3 rounded-lg shadow">
            <i data-feather="check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabla -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white px-4 py-3 font-semibold">
            Pacientes Registrados
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-center">#</th>
                        <th class="px-4 py-3 text-left">Nombre completo</th>
                        <th class="px-4 py-3 text-left">Identificacion</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Teléfono</th>
                        <th class="px-4 py-3 text-left">Fecha nacimiento</th>
                        <th class="px-4 py-3 text-left">Género</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data as $paciente)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 text-center font-medium text-gray-700">{{ $paciente->id }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $paciente->nombre }} {{ $paciente->apellido }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $paciente->numero_identificacion }}</td>
                            <td class="px-4 py-3">{{ $paciente->email }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $paciente->telefono ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 capitalize text-gray-700">{{ $paciente->genero }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center italic text-gray-500">
                                No hay pacientes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        @if($data->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t">
                {{ $data->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection
