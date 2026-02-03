<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Grade;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // 👈 PDF

class ProfessorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Profesor']);
    }

    // 🟢 PANEL DEL PROFESOR
    public function index()
    {
        // Intentos con usuario
        $attempts = Attempt::with('user')->latest()->get();

        return view('profesor', compact('attempts'));
    }

    // 🟢 GUARDAR / ACTUALIZAR CALIFICACIÓN
    public function grade(Request $request)
    {
        $request->validate([
            'attempt_id' => 'required|exists:attempts,id',
            'user_id'    => 'required|exists:users,id',
            'score'      => 'required|numeric|min:0|max:5',
            'feedback'   => 'nullable|string|max:500',
        ]);

        Grade::updateOrCreate(
            [
                'user_id'  => $request->user_id,
                'activity' => 'Intento #' . $request->attempt_id,
            ],
            [
                'score'    => $request->score,
                'feedback' => $request->feedback,
                'status'   => $request->score >= 3.5 ? 'APROBADO' : 'REPROBADO',
            ]
        );

        return back()->with('success', 'Nota guardada correctamente');
    }

    // 🟢 GENERAR PDF DEL RESULTADO (NUEVO)
    public function generarPdf()
    {
        $pdf = Pdf::loadView('pdf.resultado');

        return $pdf->download('resultado-estudiante.pdf');
    }
}
