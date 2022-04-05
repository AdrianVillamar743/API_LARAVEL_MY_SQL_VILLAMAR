<?php

namespace App\Http\Controllers;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    public function index(){
        $tareasjson=Tarea::all(); 
        return $tareasjson;
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

  
  
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|unique:tareas,nombre',
            'id_categoria'=>'required'
        ]);
         $tarea=new Tarea();
         $tarea->nombre=$request->nombre;
         $tarea->id_categoria=$request->id_categoria;
         $tarea->save();
    }

 

 
    public function update(Request $request)
    {
      
        $tarea = Tarea::findOrFail($request->id);
        $request->validate([
         'nombre' => 'required|min:3|unique:tareas,nombre',
         'id_categoria'=>'required'
     ]);
        $tarea->update($request->all());
        return $tarea;
    }


    public function destroy(Request $request)
    {
        
        $tareas = Tarea::destroy($request->id);
        return $tareas;
    }
}
