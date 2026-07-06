<?php

namespace App\Http\Controllers;

use App\Models\Camara;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CamaraController extends Controller
{
public function index(Request $request)
{
    $query = Camara::query();

    if ($request->filled('nombre')) {
        $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('ip')) {
        $query->where('ip', 'like', '%' . $request->ip . '%');
    }

    if ($request->filled('ubicacion')) {
        $query->where('ubicacion', 'like', '%' . $request->ubicacion . '%');
    }

    if ($request->filled('nvr')) {
        $query->where('nvr', 'like', '%' . $request->nvr . '%');
    }

    if ($request->filled('canal')) {
        $query->where('canal', 'like', '%' . $request->canal . '%');
    }

    if ($request->filled('mac')) {
        $query->where('mac', 'like', '%' . $request->mac . '%');
    }

    if ($request->filled('estado')) {
        $query->where('estado', 'like', '%' . $request->estado . '%');
    }

    $sort = $request->get('sort');
    if ($sort === 'ip_desc') {
        $query->orderBy('ip', 'desc');
    } else {
        $query->orderBy('ip', 'asc');
    }

    $camaras = $query->get();

    $activas = Camara::where('estado', 'DISPONIBLE')->count();
    $caidas = Camara::where('estado', 'CAIDA')->count();
    $espera = Camara::where('estado', 'ESPERA')->count();
    $total = Camara::count();

    return view('camaras.index', compact('camaras', 'activas', 'caidas', 'espera', 'total'));
}

    // FORM CREAR
    public function create()
    {
        return view('camaras.create');
    }

    // GUARDAR
    public function store(Request $request)
   {
    $request->validate([
        'nombre' => 'required|string|max:255',
        'ip' => 'required|ip',
        'ubicacion' => 'required|string|max:255',
        'nvr' => 'nullable|string|max:255',
        'mac' => 'nullable|string|max:17',
        'canal' => 'nullable|string|max:255',
    ]);

    Camara::create([
        'nombre' => $request->nombre,
        'ip' => $request->ip,
        'nvr' => $request->nvr,
        'canal' => $request->canal,
        'mac' => $request->mac,
        'ubicacion' => $request->ubicacion,
        'estado' => 'ESPERA' // estado inicial automático
    ]);

    return redirect('/camaras');
    }

    // EDITAR
    public function edit($id)
    {
        $camara = Camara::findOrFail($id);
        return view('camaras.edit', compact('camara'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ip' => 'required|ip',
            'ubicacion' => 'required|string|max:255',
            'nvr' => 'nullable|string|max:255',
            'mac' => 'nullable|string|max:17',
            'canal' => 'nullable|string|max:255',
        ]);

        $camara = Camara::findOrFail($id);
        $camara->update([
        'nombre' => $request->nombre,
        'ip' => $request->ip,
        'ubicacion' => $request->ubicacion,
        'nvr' => $request->nvr,
        'canal' => $request->canal,
        'mac' => $request->mac
    ]);

        return redirect('/camaras');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Camara::findOrFail($id)->delete();
        return redirect('/camaras');
    }

    // 🔴 VERIFICAR ESTADO (PING)
    public function verificarEstado($ip)
    {
        $output = shell_exec("ping -n 1 $ip");

        if (strpos($output, "TTL=") !== false) {
            return "DISPONIBLE";
        } else {
            return "CAIDA";
        }
    }
}