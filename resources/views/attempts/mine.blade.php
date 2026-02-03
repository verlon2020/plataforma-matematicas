<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Mis Progresos</h1>
        <table class="min-w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Fecha</th>
                    <th class="p-2 border">Módulo</th>
                    <th class="p-2 border">Ejercicio</th>
                    <th class="p-2 border">Puntaje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attempts as $attempt)
                    <tr>
                        <td class="p-2 border">{{ $attempt->created_at->format('Y-m-d H:i') }}</td>
                        <td class="p-2 border">{{ $attempt->module }}</td>
                        <td class="p-2 border">{{ $attempt->exercise }}</td>
                        <td class="p-2 border">{{ $attempt->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
