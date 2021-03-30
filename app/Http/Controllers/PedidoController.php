<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Producto;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::where("estado", "!=" , 0)->get();
        return view("admin.pedido.lista", compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Creamos el Pedido
        $pedido = new Pedido;
        $pedido->fecha_pedido = now();
        $pedido->cliente_id = 1;
        $pedido->save();
        //$pedido->codigo_qr = 


        $clientes = Cliente::get();
        $productos = Producto::where("estado", true)
                                ->where("cantidad", ">=", 1)
                                ->get();
        return view("admin.pedido.nuevo", compact("clientes", "productos", "pedido"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id_pedido = $request->id_pedido;        
        $id_cliente = $request->id_cliente;
        $carrito = $request->carrito;

        $pedido = Pedido::find($id_pedido);
        
        foreach ($carrito as $prod) {
            //return $prod['idprod'];
            $pedido->productos()->attach($prod['idprod'], ['cantidad' => $prod['cantidad']]);
        }

        return ["mensaje" => "Pedido Registrado", "datos" => $request->all()];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
