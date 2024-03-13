<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <h1 class="text-center p-3">Crud en laravel</h1>

    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("error"))
        <div class="alert alert-danger">{{session("error")}}</div>
    @endif
        
    <script>
        let respuesta=function(){
            let noti=confirm("Estas seguro de eliminar?");
            return noti;
        }
    </script>

    <div class="p-5 table-responsive">
        <button class="btn btn-success" data-bs-toggle="modal"
        data-bs-target="#ModalAgregar">Agregar Producto</button>
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col" colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $producto)
                <tr>
                    <td>{{ $producto->idProductos }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ $producto->precio }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>
                        <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#ModalEditar{{$producto->idProductos}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{route("crud.delete",$producto->idProductos)}}" onclick="return respuesta()" class="btn btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>

                    <div class="modal fade" id="ModalEditar{{$producto->idProductos}}" tabindex="-1" aria-labelledby="ModalLabelEditar{{$producto->idProductos}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabelEditar{{$producto->idProductos}}">Editar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route("crud.update")}}" method="post">
                                        @csrf
                                        <input readonly type="text" value="{{$producto->idProductos}}" class="form-control" id="txtIdProducto{{$producto->idProductos}}" name="txtIdProducto">
                                        
                                        <div class="mb-3">
                                            <label for="txtNombreProducto" class="form-label">Nombre producto</label>
                                            <input type="text" value="{{$producto->nombre}}" class="form-control" id="txtNombre{{$producto->idProductos}}" name="txtNombre">
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="txtPrecio" class="form-label">Precio</label>
                                                <input type="number" value="{{$producto->precio}}" class="form-control" id="txtPrecio{{$producto->idProductos}}" name="txtPrecio">
                                            </div>
                                            <div class="col">
                                                <label for="txtCantidad" class="form-label">Cantidad</label>
                                                <input type="number" value="{{$producto->cantidad}}" class="form-control" id="txtCantidad{{$producto->idProductos}}" name="txtCantidad">
                                            </div>
                                        </div>
                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                    
                            </div>
                        </div>
                    </div>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <!-- Modal Agregar-->
    <div class="modal fade" id="ModalAgregar" tabindex="-1" aria-labelledby="ModalLabelAgregar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabelAgregar">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route("crud.create")}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="txtNombre" class="form-label">Nombre producto</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="txtPrecio" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="txtPrecio" name="txtPrecio">
                            </div>
                            <div class="col">
                                <label for="txtCantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="txtCantidad" name="txtCantidad">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
