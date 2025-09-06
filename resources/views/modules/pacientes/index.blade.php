@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Pacientes</h1>

    
    <div class="mb-3">
        <a href="{{ route('pacientes.create') }}" class="btn btn-primary">
            Nuevo Paciente
        </a>
    </div>

    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre completo</th>
                <th>Documento</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Fecha de nacimiento</th>
                <th>Género</th>
                {{-- <th>Acciones</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse($data as $paciente)
                <tr>
                    <td>{{ $paciente->id }}</td>
                    <td>{{ $paciente->nombre }} {{ $paciente->apellido }}</td>
                    <td>{{ $paciente->documento }}</td>
                    <td>{{ $paciente->email }}</td>
                    <td>{{ $paciente->telefono }}</td>
                    <td>{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($paciente->genero) }}</td>
                    {{-- <td>
                        <a href="{{ route('pacientes.show', $paciente->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este paciente?')">
                                Eliminar
                            </button>
                        </form>
                    </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay pacientes registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
