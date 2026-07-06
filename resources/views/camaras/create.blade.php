<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cámara | UTS Redes</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-2xl">
        <!-- HEADER -->
        <div class="mb-8">
            <a href="/camaras" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al panel
            </a>
            <h1 class="text-4xl font-bold text-white mb-2">Nueva Cámara</h1>
            <p class="text-gray-400">Registra una nueva cámara en el sistema de monitoreo</p>
        </div>

        <div class="bg-white/10 backdrop-blur-2xl rounded-2xl p-8 shadow-2xl border border-white/20">
            <form action="/camaras" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- UBICACIÓN -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                Ubicación
                            </span>
                        </label>
                        <input type="text" name="ubicacion" placeholder="Ej: Entrada principal" required
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('ubicacion')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NOMBRE -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm4 2v4h8V8H6z"/>
                                </svg>
                                Nombre
                            </span>
                        </label>
                        <input type="text" name="nombre" placeholder="Ej: Cámara Entrada" required
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('nombre')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IP -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 7H7v6h6V7z"/>
                                </svg>
                                Dirección IP
                            </span>
                        </label>
                        <input type="text" name="ip" placeholder="Ej: 192.168.1.10" required
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('ip')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- MAC -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 3a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V3z"/>
                                </svg>
                                Dirección MAC
                            </span>
                        </label>
                        <input type="text" name="mac" placeholder="Ej: 00:1A:2B:3C:4D:5E"
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('mac')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NVR -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm3.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                                </svg>
                                NVR
                            </span>
                        </label>
                        <input type="text" name="nvr" placeholder="Ej: NVR-01"
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('nvr')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CANAL -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                                </svg>
                                Canal
                            </span>
                        </label>
                        <input type="text" name="canal" placeholder="Ej: Canal 1"
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('canal')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ACCIONES -->
                <div class="flex gap-4 pt-6 border-t border-white/10">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Crear Cámara
                    </button>
                    <a href="/camaras" class="flex-1 px-6 py-3 bg-gray-500/20 hover:bg-gray-500/30 border border-gray-400/30 text-gray-300 font-semibold rounded-lg transition inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>