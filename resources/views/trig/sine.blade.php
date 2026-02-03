<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-900">
            Trigonometría · Gráfica de funciones
        </h1>

        {{-- CONTROLES --}}
        <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">

            <div>
                <label class="text-sm font-semibold text-gray-700">Función base</label>
                <select id="baseFunc"
                        class="w-full border rounded px-2 py-1 bg-white text-black">
                    <option value="sin">sin(x)</option>
                    <option value="cos">cos(x)</option>
                    <option value="tan">tan(x)</option>
                    <option value="cot">cot(x)</option>
                    <option value="sec">sec(x)</option>
                    <option value="sin+cos">sin(x)+cos(x)</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Amplitud (A)</label>
                <input id="amp" type="number" value="1" step="0.1"
                       class="w-full border rounded px-2 py-1 bg-white text-black">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Frecuencia (B)</label>
                <input id="freq" type="number" value="1" step="0.1"
                       class="w-full border rounded px-2 py-1 bg-white text-black">
            </div>
        </div>

        <div class="mb-4 flex items-center gap-4">
            <button id="btnPlot"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-black rounded shadow">
                Graficar
            </button>

            <p class="text-xs text-gray-600">
                Dominio: 0° – 360°
            </p>
        </div>

        {{-- PANEL EDUCATIVO --}}
        <div class="bg-gray-100 p-4 rounded mb-4">
            <p class="text-sm">
                <strong>Función:</strong>
                <span id="funcText">sin(x)</span>
            </p>
            <p class="text-sm">
                <strong>Periodo:</strong>
                <span id="periodo">2π</span>
            </p>
        </div>

        {{-- GRÁFICA --}}
        <div class="bg-white border rounded p-4 shadow-sm">
            <canvas id="sineChart" height="140"></canvas>
        </div>

        {{-- GUARDAR PROGRESO --}}
        <form method="POST" action="{{ route('attempts.store') }}" class="mt-4">
            @csrf
            <input type="hidden" name="module" value="trig">
            <input type="hidden" name="exercise" value="sine-advanced">
            <input type="hidden" name="score" value="1">
            <button class="px-4 py-2 bg-green-600 text-black rounded">
                Marcar como completado
            </button>
        </form>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('sineChart').getContext('2d');
        const baseFunc = document.getElementById('baseFunc');
        const amp = document.getElementById('amp');
        const freq = document.getElementById('freq');
        const funcText = document.getElementById('funcText');
        const periodoText = document.getElementById('periodo');

        let chart = null;

        function generarFuncion(x) {
            const A = parseFloat(amp.value);
            const B = parseFloat(freq.value);
            const v = B * x;

            switch (baseFunc.value) {
                case 'sin': return A * Math.sin(v);
                case 'cos': return A * Math.cos(v);
                case 'tan': return A * Math.tan(v);
                case 'cot': return A / Math.tan(v);
                case 'sec': return A / Math.cos(v);
                case 'sin+cos': return A * (Math.sin(v) + Math.cos(v));
            }
        }

        function generarDatos() {
            const labels = [];
            const data = [];

            for (let deg = 0; deg <= 360; deg += 2) {
                const rad = deg * Math.PI / 180;
                let y = generarFuncion(rad);
                data.push(isFinite(y) ? y : null);
                labels.push(deg);
            }
            return { labels, data };
        }

        function dibujar() {
            const { labels, data } = generarDatos();

            if (chart) chart.destroy();

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'f(x)',
                        data,
                        borderColor: '#2563eb',
                        borderWidth: 2,
                        pointRadius: 0,
                        tension: 0.25
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            funcText.textContent =
                `f(x) = ${amp.value} · ${baseFunc.value}(${freq.value}x)`;

            periodoText.textContent =
                (2 * Math.PI / freq.value).toFixed(2);
        }

        document.getElementById('btnPlot').addEventListener('click', dibujar);
        dibujar();
    </script>
</x-app-layout>
