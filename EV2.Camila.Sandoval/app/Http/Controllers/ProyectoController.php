<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Routing\Controller; 

class ProyectoController extends Controller 
{
    // Constructor para aplicar middleware de autenticación a todas las rutas
    public function __construct()
    {
        $this->middleware('auth:api'); 
    }

    // Mostrar todos los proyectos
    public function index()
    {
        $userId = JWTAuth::user()->id; 
        
        $proyectos = Proyecto::where('creado_por', $userId)->get();
        return response()->json($proyectos);
    }

    // Crear un nuevo proyecto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|numeric',
        ]);

        $proyecto = Proyecto::create([
            'nombre' => $request->nombre,
            'fecha_inicio' => $request->fecha_inicio,
            'estado' => $request->estado,
            'responsable' => $request->responsable,
            'monto' => $request->monto,
            'creado_por' => JWTAuth::user()->id,  // Asociamos el proyecto con el usuario autenticado
        ]);

        return response()->json($proyecto, 201);  // Retorna el proyecto creado con un código 201
    }

    // Mostrar un proyecto por ID
    public function show($id)
    {
        $proyecto = Proyecto::where('creado_por', JWTAuth::user()->id)->find($id);
        
        if (!$proyecto) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }

        return response()->json($proyecto);
    }

    // Actualizar un proyecto
    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::where('creado_por', JWTAuth::user()->id)->find($id);

        if (!$proyecto) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|numeric',
        ]);

        $proyecto->update($request->all());

        return response()->json($proyecto);
    }

    // Eliminar un proyecto
    public function destroy($id)
    {
        $proyecto = Proyecto::where('creado_por', JWTAuth::user()->id)->find($id);

        if (!$proyecto) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }

        $proyecto->delete();

        return response()->json(['message' => 'Proyecto eliminado con éxito']);
    }
}