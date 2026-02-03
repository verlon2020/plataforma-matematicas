<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-700 via-purple-700 to-pink-600 py-10 px-4">

        <!-- CONTENEDOR -->
        <div class="max-w-6xl mx-auto black/10 backdrop-blur-xl rounded-3xl shadow-2xl p-10 text-white">

            <!-- HEADER -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-10">

                <div>
                    <h1 class="text-4xl font-extrabold mb-2 flex items-center gap-3">
                        🎓 Panel del Estudiante
                    </h1>
                    <p class="text-white/80 text-lg">
                        Aprende matemáticas de forma interactiva y visual
                    </p>
                </div>

                <!-- INFO USUARIO -->
                <div class="bg-white/20 rounded-2xl px-6 py-4 text-sm shadow-lg">
                    <p class="font-semibold">👤 {{ auth()->user()->name }}</p>
                    <p class="text-white/70">Rol: Estudiante</p>
                </div>

            </div>

            <!-- SECCIÓN -->
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                📊 Simulaciones Interactivas
            </h2>

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- GEOMETRÍA -->
                <a href="{{ route('geometry.cube') }}"
                   class="group bg-white/20 hover:bg-white/30 transition-all duration-300 rounded-2xl p-6 shadow-xl transform hover:-translate-y-2 hover:scale-105">
                    <div class="text-5xl mb-4">🧊</div>
                    <h3 class="text-xl font-semibold mb-2">Geometría 3D</h3>
                    <p class="text-white/80 text-sm">
                        Explora cubos 3D y comprende vértices, caras y aristas.
                    </p>
                    <div class="mt-4 text-sm font-semibold text-indigo-200 group-hover:text-white">
                        Entrar →
                    </div>
                </a>

                <!-- TRIGONOMETRÍA -->
                <a href="{{ route('trig.sine') }}"
                   class="group bg-white/20 hover:bg-white/30 transition-all duration-300 rounded-2xl p-6 shadow-xl transform hover:-translate-y-2 hover:scale-105">
                    <div class="text-5xl mb-4">📈</div>
                    <h3 class="text-xl font-semibold mb-2">Trigonometría</h3>
                    <p class="text-white/80 text-sm">
                        Visualiza la función seno y sus variaciones dinámicas.
                    </p>
                    <div class="mt-4 text-sm font-semibold text-emerald-200 group-hover:text-white">
                        Entrar →
                    </div>
                </a>

                <!-- REALIDAD AUMENTADA -->
                <a href="{{ route('ar.box') }}"
                   class="group bg-white/20 hover:bg-white/30 transition-all duration-300 rounded-2xl p-6 shadow-xl transform hover:-translate-y-2 hover:scale-105">
                    <div class="text-5xl mb-4">📱</div>
                    <h3 class="text-xl font-semibold mb-2">Realidad Aumentada</h3>
                    <p class="text-white/80 text-sm">
                        Observa objetos 3D usando tu cámara en tiempo real.
                    </p>
                    <div class="mt-4 text-sm font-semibold text-pink-200 group-hover:text-white">
                        Entrar →
                    </div>
                </a>

            </div>

            <!-- FOOTER -->
            <div class="mt-10 text-center text-white/70 text-sm">
                📌 Tu progreso se guarda automáticamente en cada simulación
            </div>

        </div>
    </div>
</x-app-layout>
