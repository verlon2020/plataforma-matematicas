<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Panel Profesor</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body{
      font-family:'Poppins',sans-serif;
      background:linear-gradient(135deg,#1f2937,#111827);
      color:#f9fafb;
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .card{
      width:96%;
      max-width:1100px;
      background:linear-gradient(180deg,rgba(255,255,255,0.06),rgba(17,24,39,0.9));
      border-radius:18px;
      box-shadow:0 20px 60px rgba(0,0,0,0.6);
      padding:1.8rem 2rem;
    }
  </style>
</head>

<body>
  <div class="card">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-2xl font-bold">Panel del Profesor 👨‍🏫</h1>
        <p class="text-gray-300 text-sm mt-1">
          Visualiza el progreso de los estudiantes en las simulaciones.
        </p>
      </div>
      <div class="text-right text-sm text-gray-300">
        <div>Sesión iniciada</div>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="text-red-400 hover:text-red-300">
          Cerrar sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
          @csrf
        </form>
      </div>
    </div>

    @if($attempts->isEmpty())
      <p class="text-gray-300">Todavía no hay intentos registrados.</p>
    @else
      <div class="overflow-x-auto mt-3">
        <table class="min-w-full border border-gray-700 text-sm">
          <thead class="bg-gray-800">
            <tr>
              <th class="px-3 py-2 border-b border-gray-700 text-left">Estudiante</th>
              <th class="px-3 py-2 border-b border-gray-700 text-left">Email</th>
              <th class="px-3 py-2 border-b border-gray-700 text-left">Módulo</th>
              <th class="px-3 py-2 border-b border-gray-700 text-left">Ejercicio</th>
              <th class="px-3 py-2 border-b border-gray-700 text-center">Puntaje</th>
              <th class="px-3 py-2 border-b border-gray-700 text-left">Fecha</th>

              {{-- 🟢 NUEVO --}}
              <th class="px-3 py-2 border-b border-gray-700 text-center">Calificar</th>
              <th class="px-3 py-2 border-b border-gray-700 text-center">Estado</th>
            </tr>
          </thead>

          <tbody class="bg-gray-900/60">
            @foreach($attempts as $attempt)
              <tr class="hover:bg-gray-800/70">
                <td class="px-3 py-2 border-b border-gray-800">
                  {{ $attempt->user?->name ?? 'Sin nombre' }}
                </td>

                <td class="px-3 py-2 border-b border-gray-800 text-gray-300">
                  {{ $attempt->user?->email ?? '-' }}
                </td>

                <td class="px-3 py-2 border-b border-gray-800">
                  {{ $attempt->module }}
                </td>

                <td class="px-3 py-2 border-b border-gray-800">
                  {{ $attempt->exercise }}
                </td>

                <td class="px-3 py-2 border-b border-gray-800 text-center font-semibold">
                  {{ $attempt->score }}
                </td>

                <td class="px-3 py-2 border-b border-gray-800 text-gray-400 text-xs">
                  {{ $attempt->created_at->format('d/m/Y H:i') }}
                </td>

                {{-- 🟢 CALIFICAR --}}
                <td class="px-3 py-2 border-b border-gray-800 text-center">
                  <form action="{{ route('profesor.grade') }}" method="POST"
                        class="flex gap-2 justify-center">
                    @csrf
                    <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">
                    <input type="hidden" name="user_id" value="{{ $attempt->user_id }}">

                    <input
                      type="number"
                      name="score"
                      step="0.1"
                      min="0"
                      max="5"
                      required
                      class="w-20 px-2 py-1 rounded bg-gray-800 border border-gray-600 text-white text-sm"
                      placeholder="0-5">

                    <button
                      type="submit"
                      class="px-2 py-1 bg-blue-600 hover:bg-blue-500 rounded text-xs">
                      Guardar
                    </button>
                  </form>
                </td>

                 




                {{-- 🟢 ESTADO --}}
                <td class="px-3 py-2 border-b border-gray-800 text-center">
                  @php
                    $grade = \App\Models\Grade::where('user_id', $attempt->user_id)
                              ->where('activity', 'Intento #' . $attempt->id)
                              ->first();
                  @endphp

                  @if($grade)
                    <span class="px-2 py-1 rounded text-xs
                      {{ $grade->status === 'Aprobado' ? 'bg-green-600' : 'bg-red-600' }}">
                      {{ $grade->status }}
                    </span>
                  @else
                    <span class="text-gray-400 text-xs">Sin nota</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</body>
</html>
