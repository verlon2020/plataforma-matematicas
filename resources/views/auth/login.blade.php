<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind (si ya lo tienes, no afecta) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900">

<div class="bg-white shadow-2xl rounded-xl w-full max-w-md p-8">

    <!-- LOGO / TITULO -->
    <div class="text-center mb-6">
        <div class="text-4xl font-bold text-indigo-700">📘 Plataforma Matemáticas</div>
        <p class="text-gray-500 mt-2">Acceso al sistema académico</p>
    </div>

    <!-- MENSAJES DE SESIÓN -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600 text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- ERRORES -->
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORMULARIO -->
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- EMAIL -->
        <div>
            <label class="block text-gray-700 text-sm mb-1">Correo electrónico</label>
            <input 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                placeholder="ejemplo@correo.com"
            >
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="block text-gray-700 text-sm mb-1">Contraseña</label>
            <input 
                type="password" 
                name="password" 
                required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                placeholder="********"
            >
        </div>

        <!-- RECORDAR -->
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="mr-2">
                Recordarme
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <!-- BOTÓN LOGIN -->
        <button 
            type="submit"
            class="w-full bg-indigo-700 hover:bg-indigo-800 text-white py-2 rounded-lg font-semibold transition">
            Iniciar Sesión
        </button>

        <!-- REGISTRO -->
        <div class="text-center text-sm mt-4">
            ¿No tienes cuenta?  
            <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">
                Regístrate aquí
            </a>
        </div>
    </form>
</div>

</body>
</html>
