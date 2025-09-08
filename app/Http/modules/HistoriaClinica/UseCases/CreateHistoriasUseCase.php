<?php

namespace App\Http\Modules\HistoriaClinica\UseCases;

use App\Http\Modules\HistoriaClinica\Requests\HistoriasStoreRequest;
use App\Models\HistoriaClinica;

class CreateHistoriasUseCase
{
    public $rules = [];
    protected $model = HistoriaClinica::class;

    public function __invoke(HistoriasStoreRequest $request)
    {
        // Validar datos con el request
        $data = $request->validated();

        // Procesar archivos de evidencias si existen
        if ($request->hasFile('evidencias')) {
            $paths = [];
            foreach ($request->file('evidencias') as $file) {
                $paths[] = $file->store('evidencias', 'public');
            }
            $data['evidencias'] = json_encode($paths);
        }

        // Crear historia clínica con datos validados
        $historia = new HistoriaClinica($data);
        $historia->save();

        return $historia;
    }
}
