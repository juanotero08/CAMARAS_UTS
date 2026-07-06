<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | UTS Redes y Comunicaciones</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        <div class="bg-white/10 backdrop-blur-2xl rounded-2xl p-8 shadow-2xl border border-white/20">
            <div class="text-center mb-8">
                <div class="flex justify-center items-center gap-4 mb-4">
                    <img src="{{ asset('images/uts-logo.png') }}" alt="UTS Logo" class="h-20 w-auto drop-shadow-lg">
                    <img src="{{ asset('images/redes-logo.png') }}" alt="Redes Logo" class="h-20 w-auto drop-shadow-lg">
                </div>
                <h1 class="text-3xl font-bold text-white mb-1">UTS Monitoreo</h1>
                <p class="text-emerald-200/70 text-sm font-medium">Redes & Comunicaciones</p>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white mb-1">Bienvenido</h2>
                <p class="text-gray-300 text-sm">Sistema de monitoreo de cámaras</p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-500/20 border border-red-400/30 rounded-lg">
                    <p class="text-red-200 text-sm font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition"
                        placeholder="tu@correo.com">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Contraseña</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition"
                        placeholder="••••••••">
                </div>

                <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold rounded-lg hover:from-emerald-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-slate-950 transition shadow-lg mt-6">
                    Ingresar al Sistema
                </button>
            </form>

        

        <p class="text-center text-gray-400 text-xs mt-6">
            © 2026 UTS Redes y Comunicaciones. Todos los derechos reservados.
        </p>
    </div>
</body>
</html>
