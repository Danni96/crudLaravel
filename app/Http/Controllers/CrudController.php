<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function index()
    {
        $datos = DB::select("SELECT p.idProductos, p.nombre, p.precio, p.cantidad, p.idCategoria, c.categorias as categoria FROM productos p, categorias c WHERE p.idCategoria = c.idCategorias");

        $categorias = DB::select("select c.idCategorias, c.categorias as categoria_nombre from categorias c");
        
        return view("welcome")->with("datos", $datos)->with("categorias", $categorias);
    }

    public function create(Request $request){
        
        if(empty($request->txtNombre) || empty($request->txtPrecio) || empty($request->txtCantidad)){
            return back()->with("error", "Error: Todos los campos son requeridos");
        }
    
        $sql = DB::insert("insert into productos(nombre,precio,cantidad,idCategoria) values(?,?,?,?)", [
            $request->txtNombre,
            $request->txtPrecio,
            $request->txtCantidad,
            $request->txtIdCategorias,
        ]);
        if($sql == true){
            return back()->with("correcto", "El producto se agregó");
        }else{
            return back()->with("error", "Error: El producto no se agregó");
        }
    }

    public function update(Request $request)
    {
        if(empty($request->txtNombre) || empty($request->txtPrecio) || empty($request->txtCantidad) || empty($request->txtIdProducto) || empty($request->txtIdCategorias)){
            return back()->with("error", "Error: Todos los campos son requeridos");
        }
    
        try {
            $sql = DB::update("UPDATE productos SET nombre=?, precio=?, cantidad=?, idCategoria=? WHERE idProductos=?", [
                $request->txtNombre,
                $request->txtPrecio,
                $request->txtCantidad,
                $request->txtIdCategorias,
                $request->txtIdProducto,
            ]);
        } catch(\Throwable $th) {
            $sql = 0;
        }
        
        if($sql > 0){
            return back()->with("correcto", "El producto se modificó");
        } else {
            return back()->with("error", "Error: El producto no se modificó");
        }
    }
    


    public function delete($id){
        try {
            $sql = DB::delete("delete from productos where idProductos = $id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if($sql == true){
            return back()->with("correcto", "El producto se eliminó correctamente");
        }else{
            return back()->with("error", "Error: El producto no se eliminó");
        }
    }

    
}

