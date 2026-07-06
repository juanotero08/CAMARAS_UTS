<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Monitoreo | UTS Redes</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .stat-card:hover { transform: translateY(-4px); }
        .table-row-hover { transition: all 0.2s ease; }
        .table-row-hover:hover { background-color: rgba(16, 185, 129, 0.05); }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/3 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative">
        <!-- NAVBAR -->
        <nav class="border-b border-white/10 bg-white/5 backdrop-blur-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/uts-logo.png') }}" alt="UTS Logo" class="h-12 w-auto">
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl font-bold text-white">Panel de Control</h1>
                            <img src="{{ asset('images/redes-logo.png') }}" alt="Redes Logo" class="h-12 w-auto">
                        </div>
                    </div>

                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-200 rounded-lg text-sm font-medium transition border border-red-400/20">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- HEADER CON BOTÓN -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-1">Monitoreo de Cámaras</h2>
                    <p class="text-gray-400">Gestión y estado de todas las cámaras del sistema</p>
                </div>
                <a href="/camaras/create" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva Cámara
                </a>
            </div>

            <!-- STATS CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 hover:border-white/40 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-sm font-medium mb-1">Total</p>
                            <h3 class="text-4xl font-bold text-white">{{ $total }}</h3>
                        </div>
                        <div class="p-3 bg-blue-500/20 rounded-lg">
                            <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 hover:border-emerald-400/40 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-sm font-medium mb-1">Activas</p>
                            <h3 class="text-4xl font-bold text-emerald-400">{{ $activas }}</h3>
                        </div>
                        <div class="p-3 bg-emerald-500/20 rounded-lg">
                            <svg class="w-6 h-6 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 hover:border-red-400/40 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-sm font-medium mb-1">Caídas</p>
                            <h3 class="text-4xl font-bold text-red-400">{{ $caidas }}</h3>
                        </div>
                        <div class="p-3 bg-red-500/20 rounded-lg">
                            <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 hover:border-yellow-400/40 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-sm font-medium mb-1">En Espera</p>
                            <h3 class="text-4xl font-bold text-yellow-400">{{ $espera }}</h3>
                        </div>
                        <div class="p-3 bg-yellow-500/20 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FILTROS -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 mb-8 shadow-lg">
                <h3 class="text-white font-semibold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Búsqueda Avanzada
                </h3>
                <form method="GET" action="/camaras" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <input type="text" name="ubicacion" placeholder="Ubicación" value="{{ request('ubicacion') }}"
                        class="px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <input type="text" name="nombre" placeholder="Nombre" value="{{ request('nombre') }}"
                        class="px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <input type="text" name="ip" placeholder="IP" value="{{ request('ip') }}"
                        class="px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <input type="text" name="mac" placeholder="MAC" value="{{ request('mac') }}"
                        class="px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <input type="text" name="nvr" placeholder="NVR" value="{{ request('nvr') }}"
                        class="px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <input type="text" name="canal" placeholder="Canal" value="{{ request('canal') }}"
                        class="px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <select name="estado" class="px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        <option value="" class="bg-slate-900">Estado</option>
                        <option value="DISPONIBLE" class="bg-slate-900" {{ request('estado') == 'DISPONIBLE' ? 'selected' : '' }}>Disponible</option>
                        <option value="CAIDA" class="bg-slate-900" {{ request('estado') == 'CAIDA' ? 'selected' : '' }}>Caída</option>
                        <option value="ESPERA" class="bg-slate-900" {{ request('estado') == 'ESPERA' ? 'selected' : '' }}>En espera</option>
                    </select>
                    <button type="submit" class="lg:col-span-1 px-4 py-2 bg-emerald-500/20 hover:bg-emerald-500/30 border border-emerald-400/30 text-emerald-300 rounded-lg font-medium transition">
                        Buscar
                    </button>
                    <a href="/camaras" class="lg:col-span-1 px-4 py-2 bg-gray-500/20 hover:bg-gray-500/30 border border-gray-400/30 text-gray-300 rounded-lg font-medium transition text-center">
                        Limpiar
                    </a>
                </form>
            </div>

            <!-- TABLA -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-emerald-500/20 to-teal-500/20 border-b border-white/10">
                            <tr>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-200 whitespace-nowrap">Ubicación</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-200 whitespace-nowrap">Nombre</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-200 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <span>IP</span>
                                        <div class="flex flex-col">
                                            <a href="{{ url('/camaras') . '?' . http_build_query(array_merge(request()->except('sort'), ['sort' => 'ip_asc'])) }}" class="leading-none text-[10px] {{ request('sort') === 'ip_asc' ? 'text-emerald-300' : 'text-gray-400 hover:text-white' }}" title="Ordenar ascendente">▲</a>
                                            <a href="{{ url('/camaras') . '?' . http_build_query(array_merge(request()->except('sort'), ['sort' => 'ip_desc'])) }}" class="leading-none text-[10px] {{ request('sort') === 'ip_desc' ? 'text-emerald-300' : 'text-gray-400 hover:text-white' }}" title="Ordenar descendente">▼</a>
                                        </div>
                                    </div>
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-200 whitespace-nowrap">MAC</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-200 whitespace-nowrap">NVR / Canal</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-200 whitespace-nowrap">Estado</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-200 whitespace-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse($camaras as $camara)
                                <tr class="table-row-hover">
                                    <td class="px-3 py-3">
                                        <span class="text-gray-300 font-medium text-xs">{{ $camara->ubicacion }}</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <span class="text-gray-300 text-xs">{{ $camara->nombre }}</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <code class="text-emerald-300 bg-emerald-500/10 px-2 py-1 rounded text-xs font-mono block max-w-[120px]">{{ $camara->ip }}</code>
                                    </td>
                                    <td class="px-3 py-3">
                                        <code class="text-blue-300 bg-blue-500/10 px-2 py-1 rounded text-xs font-mono block max-w-[140px]">{{ $camara->mac ?? 'N/A' }}</code>
                                    </td>
                                    <td class="px-3 py-3">
                                        <span class="text-gray-400 text-xs whitespace-nowrap">{{ $camara->nvr ?? 'N/A' }} / {{ $camara->canal ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        @if($camara->estado == 'DISPONIBLE')
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-emerald-500/20 border border-emerald-400/30 rounded-full text-emerald-300 text-xs font-medium">
                                                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                                                <span class="hidden sm:inline">Disponible</span>
                                            </span>
                                        @elseif($camara->estado == 'CAIDA')
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-500/20 border border-red-400/30 rounded-full text-red-300 text-xs font-medium">
                                                <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                                <span class="hidden sm:inline">Caída</span>
                                            </span>
                                        @elseif($camara->estado == 'ESPERA')
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-500/20 border border-yellow-400/30 rounded-full text-yellow-300 text-xs font-medium">
                                                <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                                                <span class="hidden sm:inline">En espera</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3">
                                        <div class="flex gap-1 flex-wrap">
                                            <a href="/camaras/{{ $camara->id }}/edit" class="px-2 py-1 bg-blue-500/20 hover:bg-blue-500/30 border border-blue-400/30 text-blue-300 rounded text-xs font-medium transition whitespace-nowrap">
                                                Editar
                                            </a>
                                            <form action="/camaras/{{ $camara->id }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta cámara?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-500/20 hover:bg-red-500/30 border border-red-400/30 text-red-300 rounded text-xs font-medium transition whitespace-nowrap">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                            <p class="text-gray-400">No hay cámaras registradas</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>