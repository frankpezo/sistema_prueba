<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index(){
        
        $ventas = Venta::where('estado', 1)->get();
        return view('detalleVenta', compact('ventas'));
    }


    public function destroy($idventa)
    {
        $venta = Venta::findOrFail($idventa);

        $venta->estado = 0; // Anulado
        $venta->save();

        return redirect()->route('index.detalleVenta')->with('success', 'Venta anulada correctamente.');
    }
 
    
}
