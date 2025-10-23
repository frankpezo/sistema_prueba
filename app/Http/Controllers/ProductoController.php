<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Http\Requests\ProductoRequest;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(){
        $productos = Producto::where('estado', 1)->get();
        return view('productos', compact('productos'));
    }

    public function create(ProductoRequest $request){
       
        Producto::create([
            'nombre_producto' => ucwords(mb_strtolower($request->productoNombre, 'UTF-8')), 
            'precio_producto' => $request->productoPrecio,
            'stock_producto' => $request->productoStock,
           
        ]);

        

          return redirect()->route('index.productos')->with('success', 'Producto creado correctamente');
    }
    

    public  function show($idproducto){
       $productos = Producto::findOrFail($idproducto);
       return view('productoedit', compact('productos'));
    }

    public function update($idproducto, EditProductRequest $request){
        $producto = Producto::findOrFail($idproducto);

        $producto->update([
            'nombre_producto' => ucwords(mb_strtolower($request->productoNombreEdit, 'UTF-8')), 
            'precio_producto' => $request->productoPrecioEdit,
            'stock_producto' => $request->productoStockEdit,
        ]);

        return redirect()->route('index.productos')->with('success', 'Producto actualizado correctamente');
    }


/*     public function store(){
        Venta::create([
            'cod_venta' => 'VENTA-001',
            'fecha_venta' => now(),
            'importe_bruto' => 0,
            'igv' => 0,
            'importe_total' => 0,
        ]);
    } */

 public function destroy($iddetalle)
{
    // Eliminar lógicamente el detalle
    $detalle = DetalleVenta::findOrFail($iddetalle);
    $detalle->update([
        'estado' => 0,
    ]);

    // Obtener solo los detalles activos
    $detallesActivos = DetalleVenta::where('estado', 1)->get();

    // Calcular los totales solo de los activos
    $importeBruto = $detallesActivos->sum('subtotal_total');
    $igv = $importeBruto * 0.18;
    $importeTotal = $importeBruto + $igv;

    // Actualizar los totales solo en los registros activos
    foreach ($detallesActivos as $item) {
        $item->update([
            'importe_bruto' => $importeBruto,
            'igv' => $igv,
            'importe_total' => $importeTotal,
        ]);
    }

    return redirect()->route('index.venta')->with('success', 'Producto eliminado y totales actualizados.');
}



    

}
