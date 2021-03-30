<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Carbon\Carbon;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->fini){
            $f_ini = $request->fini;
            $f_fin = $request->ffin;

            $categorias = Categoria::where("created_at", ">", $f_ini)
                        ->where("created_at", "<=", $f_fin)->paginate(15);
        }else{
            if($request->buscar){
                $categorias = Categoria::where("nombre", "like", "%".$request->buscar."%")->paginate(5);
            }else{
                $categorias = Categoria::paginate(5); 
            }
           //return Carbon::parse("18-03-2021")->translatedFormat("d \de F \de\l Y");
        }   
        return view("admin.categoria.listar", compact("categorias"));
                 
       
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categoria.crear");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $reglas = [
            "nombre" => "required|unique:categorias|min:3|max:30",
            "detalle" => "required"
        ];

        $request->validate($reglas);

        // Guardar en la base de datos
        $cat = new Categoria;
        $cat->nombre = $request->nombre;
        $cat->detalle = $request->detalle;
        $cat->save();

        return redirect("/admin/categoria");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        return view("admin.categoria.mostrar", compact("categoria"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view("admin.categoria.editar", compact("categoria"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cat = Categoria::find($id);
        $cat->nombre = $request->nombre;
        $cat->detalle = $request->detalle;
        $cat->save();

        return redirect("/admin/categoria");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Categoria::find($id);
        $cat->delete();
        return redirect("/admin/categoria");
    }

    
}
