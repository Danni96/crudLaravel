<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function index(){
        $datos = DB::select('select * from productos');
        return view("welcome")->with("datos", $datos);

    }

    public function create(Request $request){
        
        if(empty($request->txtNombre) || empty($request->txtPrecio) || empty($request->txtCantidad)){
            return back()->with("error", "Error: Todos los campos son requeridos");
        }
    
        $sql = DB::insert("insert into productos(nombre,precio,cantidad) values(?,?,?)", [
            $request->txtNombre,
            $request->txtPrecio,
            $request->txtCantidad,
        ]);
        if($sql == true){
            return back()->with("correcto", "El producto se agregó");
        }else{
            return back()->with("error", "Error: El producto no se agregó");
        }
    }

    public function update(Request $request){
        
        if(empty($request->txtNombre) || empty($request->txtPrecio) || empty($request->txtCantidad) || empty($request->txtIdProducto)){
            return back()->with("error", "Error: Todos los campos son requeridos");
        }
    
        try {
            $sql = DB::insert("update productos set nombre=?, precio=?, cantidad=? where idProductos=?", [
                $request->txtNombre,
                $request->txtPrecio,
                $request->txtCantidad,
                $request->txtIdProducto,
            ]);
            if($sql == 0){
                $sql = 1;
            }
        } catch(\Throwable $th) {
            $sql = 0;
        }
        
        if($sql == true){
            return back()->with("correcto", "El producto se modifico");
        }else{
            return back()->with("error", "Error: El producto no se modifico");
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

