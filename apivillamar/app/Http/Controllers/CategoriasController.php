<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
class CategoriasController extends Controller
{
    public function index(){
        $categoriasjson=Categoria::all(); 
        return $categoriasjson;
      }
 
  
  
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|unique:categorias,nombre',
         
        ]);
         $categoria=new Categoria();
         $categoria->nombre=$request->nombre;
         $categoria->save();
    }

 

 
    public function update(Request $request)
    {
      
        $categoria = Categoria::findOrFail($request->id);
        $request->validate([
         'nombre' => 'required|min:3|unique:categorias,nombre'
     ]);
        $categoria->update($request->all());
        return $categoria;
    }


    public function destroy(Request $request)
    {
        
        $categoria = Categoria::destroy($request->id);
        return $categoria;
    }
}
