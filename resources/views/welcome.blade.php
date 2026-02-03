<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma Educativa 3D</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #020617);
        }
    </style>
</head>
<body class="text-white min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="flex justify-between items-center px-8 py-5">
        <h1 class="text-xl font-bold tracking-wide">
            📘 Plataforma Educativa 3D
        </h1>

        <a href="{{ route('login') }}"
           class="px-5 py-2 rounded bg-blue-600 hover:bg-blue-500 transition font-semibold">
            Iniciar sesión
        </a>
    </header>

    <!-- HERO -->
    <section class="flex-1 flex flex-col items-center justify-center text-center px-6">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
            Aprende Matemáticas de forma Visual e Interactiva
        </h2>

        <p class="max-w-3xl text-gray-300 text-lg mb-8">
            Explora conceptos matemáticos mediante simulaciones 3D, gráficas dinámicas
            y experiencias inmersivas que facilitan la comprensión y despiertan el interés
            por el aprendizaje.
        </p>

        <a href="{{ route('login') }}"
           class="px-8 py-4 bg-green-600 hover:bg-green-500 rounded-xl text-lg font-bold transition shadow-lg">
            Comenzar ahora 🚀
        </a>
    </section>

    <!-- FEATURES -->
    <section class="bg-slate-900 py-14 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-slate-800 p-6 rounded-xl hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-3">🧊 Geometría 3D</h3>
                <p class="text-gray-300 text-sm">
                    Visualiza figuras tridimensionales, rota objetos y comprende
                    relaciones espaciales de forma intuitiva.
                </p>
            </div>

            <div class="bg-slate-800 p-6 rounded-xl hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-3">📈 Trigonometría</h3>
                <p class="text-gray-300 text-sm">
                    Analiza funciones matemáticas mediante gráficas dinámicas
                    ajustando amplitud, frecuencia y forma.
                </p>
            </div>

            <div class="bg-slate-800 p-6 rounded-xl hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-3">🥽 Realidad Aumentada</h3>
                <p class="text-gray-300 text-sm">
                    Conecta el mundo real con modelos virtuales para lograr
                    experiencias educativas inmersivas.
                </p>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center py-6 text-gray-400 text-sm">
        © {{ date('Y') }} Plataforma Educativa 3D · Proyecto Académico
    </footer>

</body>
</html>
