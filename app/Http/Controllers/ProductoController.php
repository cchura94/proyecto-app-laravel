<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate(10);
        //Producto::join("categorias", "productos.categoria_id", "=", "categorias.id")->get()
        //DB::select("select p.*, c.nombre from productos as p, categorias as c inner join ()")
        return view("admin.producto.listar", compact("productos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view("admin.producto.crear", compact("categorias"));
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
        $request->validate([
            "nombre" => "required|min:2|max:200",
            //'imagen' => 'required'

        ]);

        /*$validator = Validator::make($request->all(), [
            'imagen' => 'dimensions:min_width=100,min_height=200|max:5000',
        ]);*/

        // Subida de Imagen
        $nombre_imagen = "";
        if($file = $request->file("imagen")){
            //tamaño de la imagen
            //return $file->getC
            //$_FILES["file-input"]["size"] > 2000000
            // obtener el nombre del archivo
            $nombre_imagen = time()."-". $file->getClientOriginalName();
            $file->move("imagenes", $nombre_imagen);
        }
        //guardar en la BD
        $prod = new Producto;
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->imagen = "/imagenes/".$nombre_imagen;
        $prod->categoria_id = $request->categoria_id;
        $prod->save();
        return redirect("/producto")->with("ok", "Producto Registrado");        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return view("admin.producto.mostrar", compact("producto"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Categoria::all();
        return view("admin.producto.editar", compact("categorias"));
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
        //validar

        //modificar
        $prod = Producto::find($id);

        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->imagen = "";
        $prod->categoria_id = $request->categoria_id;
        $prod->save();

        return redirect("/producto")->with("ok", "Producto Modificado");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Producto::find($id);
        $prod->delete();
        
        return redirect("/producto")->with("ok", "Producto Eliminado");
    }
}
