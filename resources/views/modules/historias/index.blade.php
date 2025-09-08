@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Historias</h1>

    
    <div class="mb-3">
        <a href="{{ route('historias.create') }}" class="btn btn-primary">
            Nueva Historia Clin
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
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Antecedentes</th>
                <th>Sintomas</th>
                <th>Diagnostico</th>
                <th>--evidencias</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $historia)
                <tr>
                    <td>{{ $historia->id }}</td>
                    <td>{{ $historia->paciente_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($historia->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $historia->motivo_consulta }}</td>
                    <td>{{ $historia->antecedentes }}</td>
                    <td>{{ $historia->sintomas }}</td>
                    <td>{{ $$historia->diagnostico_presuntivo }}</td>
                    <td>{{ $historia->evidencias }}</td>
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
