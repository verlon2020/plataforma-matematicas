<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 via-purple-800 to-blue-900">

<div class="bg-white shadow-2xl rounded-xl w-full max-w-md p-8">

    <!-- ENCABEZADO -->
    <div class="text-center mb-6">
        <div class="text-4xl font-bold text-indigo-700">🧠 Plataforma Matemáticas</div>
        <p class="text-gray-500 mt-2">Registro de nuevo usuario</p>
    </div>

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
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- NOMBRE -->
        <div>
            <label class="block text-gray-700 text-sm mb-1">Nombre completo</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                placeholder="Juan Pérez">
        </div>

        <!-- EMAIL -->
        <div>
            <label class="block text-gray-700 text-sm mb-1">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                placeholder="correo@ejemplo.com">
        </div>

        <!-- ROL -->
        <div>
            <label class="block text-gray-700 text-sm mb-2">Registrarme como</label>
            <select name="role_id" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                <option value="">Seleccione un rol</option>
                <option value="3">🎓 Estudiante</option>
                <option value="2">👨‍🏫 Profesor</option>
            </select>
        </div>

        <!-- CONTRASEÑA -->
        <div>
            <label class="block text-gray-700 text-sm mb-1">Contraseña</label>
            <input type="password" name="password" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- CONFIRMAR CONTRASEÑA -->
        <div>
            <label class="block text-gray-700 text-sm mb-1">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- BOTÓN -->
        <button type="submit"
            class="w-full bg-indigo-700 hover:bg-indigo-800 text-white py-2 rounded-lg font-semibold transition">
            Registrarse
        </button>

        <!-- LOGIN -->
        <div class="text-center text-sm mt-4">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">
                Inicia sesión
            </a>
        </div>
    </form>
</div>

</body>
</html>
