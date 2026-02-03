<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attempt;

class SimulationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // protege todas las acciones
    }

    // Vista del cubo 3D
    public function cube()
    {
        return view('geometry.cube');
    }

    // Vista de Trigonometría (gráfica de seno)
    public function sine()
    {
        return view('trig.sine');
    }

    // Vista de AR (Caja en marcador)
    public function arBox()
    {
        return view('ar.box');
    }

    // Guardar intento / progreso
    public function storeAttempt(Request $request)
    {
        $data = $request->validate([
            'module'   => 'required|string|max:50',
            'exercise' => 'required|string|max:50',
            'score'    => 'nullable|integer|min:0|max:100',
            'data'     => 'nullable', // puede venir como JSON string
        ]);

        $data['user_id'] = $request->user()->id;

        // Si envías 'data' como string JSON desde el front, intenta decodificar:
        if (isset($data['data']) && is_string($data['data'])) {
            $decoded = json_decode($data['data'], true);
            $data['data'] = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
        }

        // Si dejaste el índice único, puedes usar updateOrCreate:
        // Attempt::updateOrCreate(
        //     ['user_id'=>$data['user_id'], 'module'=>$data['module'], 'exercise'=>$data['exercise']],
        //     ['score'=>$data['score'] ?? 0, 'data'=>$data['data'] ?? null]
        // );

        // Si no hay índice único, simplemente crea:
        Attempt::create($data);

        return back()->with('status', 'Progreso guardado ✅');
    }
}
