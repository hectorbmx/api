<?php


namespace App\Http\Controllers;
use App\Models\Entreno;
use Illuminate\Http\Request;


class EntrenoController extends Controller
{
    //mostrar todos los entrenamientos
    public function index()
    {
        $entrenos =Entreno::all();
        return response()->json($entrenos);
    }
    public function show($id)
    {
        $entreno = Entreno::find($id);

        if(!$entreno){
            
            return response()->json(['message' => 'Entreno no encontrado'], 404);

        }
        return response()->json($entreno);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'titulo' => 'required|string|max:255',
            'seccion1' => 'nullable|string',
            'seccion2' => 'nullable|string',
            'seccion3' => 'nullable|string',
            'seccion4' => 'nullable|string',
            'usuario_id' => 'required|exists:users,id',
        ]);

        $entreno = Entreno::create($validated);

        return response()->json(['message' => 'Entreno creado exitosamente', 'entreno' => $entreno], 201);
    }

    /**
     * Obtener entreno por fecha.
     */
    public function getByDate($fecha)
    {
        $entreno = Entreno::where('fecha', $fecha)->first();

        if (!$entreno) {
            return response()->json(['message' => 'No se encontró un entreno para la fecha proporcionada'], 404);
        }

        return response()->json($entreno);
    }


    /**
     * Actualizar un entreno existente.
     */
    public function update(Request $request, $id)
    {
        $entreno = Entreno::find($id);

        if (!$entreno) {
            return response()->json(['message' => 'Entreno no encontrado'], 404);
        }

        $validated = $request->validate([
            'fecha' => 'nullable|date',
            'titulo' => 'nullable|string|max:255',
            'seccion1' => 'nullable|string',
            'seccion2' => 'nullable|string',
            'seccion3' => 'nullable|string',
            'seccion4' => 'nullable|string',
            'usuario_id' => 'nullable|exists:users,id',
        ]);

        $entreno->update($validated);

        return response()->json(['message' => 'Entreno actualizado exitosamente', 'entreno' => $entreno]);
    }

    /**
     * Eliminar un entreno.
     */
    public function destroy($id)
    {
        $entreno = Entreno::find($id);

        if (!$entreno) {
            return response()->json(['message' => 'Entreno no encontrado'], 404);
        }

        $entreno->delete();

        return response()->json(['message' => 'Entreno eliminado exitosamente']);
    }
}