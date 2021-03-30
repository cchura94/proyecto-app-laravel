@extends("layouts.admin")

@section("titulo", "Nuevo Pedido")

@section("contenedor")

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">ID PEDIDO</label>
                        <input type="text" class="form-control" value="{{ $pedido->id }}" readonly name="id_pedido" id="id_pedido">
                    </div>
                    <div class="col-md-4">
                        QR
                    </div>
                    <div class="col-md-4">
                    <label for="">FECHA P:</label>
                    <input type="text" class="form-control" value="{{ $pedido->fecha_pedido }}" readonly name="fecha_pedido">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
            <table id="example1" class="table table-striped table-hover">
    <thead>
    <tr>
        <td>NOMBRE</td>
        <td>PRECIO</td>
        <td>CANTIDAD</td>
        <td>CATEGORIA</td>
        <td>IMAGEN</td>
        <td>Seleccionar</td>
    </tr>
    </thead>
    <tbody>

    
    @foreach ($productos as $prod)        
    <tr>
        <td>{{ $prod->nombre }}</td>
        <td>{{ $prod->precio }}</td>
        <td>
            <select name="cantidad_comprar[{{$prod->id}}][]" id="" class="form-control" required>
                <option value="">Seleccionar</option>
                @for($i = 1; $i <= $prod->cantidad; $i++)
                <option value="{{ $i }}">{{ $i }}</option>                    
                @endfor
            </select>
        </td>
        <td>{{ $prod->categoria->nombre }}</td>
        <td>
          <img src="{{ asset($prod->imagen) }}" width="100px" alt="">        
        </td>
        <td>
            <input type="checkbox" name="productos[]" class="form-control" value="{{ $prod->id }}">
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Modal{{ $prod->id }}">
  seleccionar
</button>

<!-- Modal -->
<div class="modal fade" id="Modal{{ $prod->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SELECCIONAR CANTIDAD A VENDER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h2>NOMBRE: {{ $prod->nombre }}</h2>
            <select id="cant-{{$prod->id}}" class="form-control" required>
                <option value="">Seleccionar</option>
                @for($i = 1; $i <= $prod->cantidad; $i++)
                <option value="{{ $i }}">{{ $i }}</option>                    
                @endfor
            </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
 
        <button type="button" class="btn btn-primary" onclick='agregarCarrito(@json($prod))'>Agregar al Carrito</button>
      </div>
    </div>
  </div>
</div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Carrito</h2>
                        <table class="table">
                            <tr>
                                <td>PROD</td>
                                <td>CANT</td>
                                <td>SUB.T.</td>
                                <td>ACCION</td>
                            </tr>
                            <tbody id="carrito">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Datos Cliente</h1>
                        
                        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  CLIENTE
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buscar Clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="buscar" onkeyup="buscarCliente()">
        <button>Buscar</button>
        <hr>
        <table class="table table-striped table-hover">
            <tr>
                <td>NOMBRES</td>
                <td>APELLIDOS</td>
                <td>CORREO</td>
                <td>ACCION</td>
            </tr>
            <tbody id="datoscliente">
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


                    </div>
                </div>
            </div>
        
        </div>
        
    </div>
    

   
</div>
<input type="button" onclick="realizarPedido()" value="Realizar Pedido">

@endsection


@section("js")
<script>
var productos = [];

    function agregarCarrito(prod){
        var id_prod = prod;
        //console.log("Producto: ", id_prod)
        var select_id_cant = "cant-"+id_prod.id; 
        var cant = document.getElementById(select_id_cant).value;
        //console.log("CANTIDAD: ", cant)
        productos.push({nombre: id_prod.nombre, idprod: id_prod.id, cantidad: cant, subt: (cant*id_prod.precio)});
        console.log(productos);

        $('#Modal'+id_prod.id).modal('hide');
        
        actualizarCarrito();
    }

    function actualizarCarrito(){
        var cad = ``;
        for (let i = 0; i < productos.length; i++) {
            const producto = productos[i];
            cad += `<tr><td>${productos[i].nombre}</td>
                    <td>${productos[i].cantidad}</td>
                    <td>${productos[i].subt}</td>
                    <td><button>x</button></td></tr>`; 
            
        }
        document.getElementById("carrito").innerHTML = cad;
    }

    function realizarPedido() {
        var id_ped = document.getElementById("id_pedido").value;

        var pedido = {
            id_pedido: id_ped,
            id_cliente: 1,
            carrito: productos 
        }
        console.log(pedido);

        fetch("/admin/pedido", {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            method: 'POST',
            body: JSON.stringify(pedido) 
        }).then((respuesta) => respuesta.json()
        ).then(function(resultado){
            console.log(resultado)
            alert("Pedido Registrado")
        })
        .catch(function(error){
            console.log(error);
        });

    }

    function buscarCliente(){
        var buscar = document.getElementById("buscar").value;
        console.log("buscar: "+ buscar)

        fetch("/admin/cliente?buscar="+buscar, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            method: 'GET',
            //body: {buscar: buscar} 
        }).then((respuesta) => respuesta.json()
        ).then(function(resultado){
            console.log(resultado)
            //alert("Pedido Registrado")
            var cad = ``;
            for (let i = 0; i < resultado.length; i++) {
                const cliente = resultado[i];
                cad += `<tr>
                <td>${cliente.nombres}</td>
                    <td>${cliente.apellidos}</td>
                    <td>${cliente.ci_nit}</td>   
                    <td><button>seleccionar</button></td>                 
                </tr>`;
            }
            document.getElementById("datoscliente").innerHTML = cad
        })
        .catch(function(error){
            console.log(error);
        });
    }
</script>
@endsection