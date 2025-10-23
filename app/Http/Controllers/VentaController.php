<?php

namespace App\Http\Controllers;

use App\Http\Requests\VentaRequest;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $productos = Producto::where('estado', 1)->get();
        $detalles = DetalleVenta::where('estado', 1)->get();

        // Calcular totales solo de los activos
        $importeBruto = $detalles->sum('subtotal_total');
        $igv = $importeBruto * 0.18;
        $importeTotal = $importeBruto + $igv;

        return view('venta', compact('productos', 'detalles', 'importeBruto', 'igv', 'importeTotal'));
    }



    public function create(VentaRequest $request)
    {
        $producto = Producto::findOrFail($request->productoList);

        $precio = $producto->precio_producto;
        $cantidad = $request->productoCantidad;
        $descuento = $request->productoDescuento;

        // Subtotales individuales
        $subtotalBruto = $precio * $cantidad;
        $subtotalTotal = $subtotalBruto * (1 - $descuento / 100);

        // Crear el detalle con estado activo
        DetalleVenta::create([
            'id_producto' => $producto->id,
            'cantidad' => $cantidad,
            'precio_unitario' => $precio,
            'subtotal_bruto' => $subtotalBruto,
            'descuento' => $descuento,
            'subtotal_total' => $subtotalTotal,
            'estado' => 1,
        ]);

        
        $this->recalcularTotalesActivos();

        return redirect()->route('index.venta')->with('success', 'Se añadió el detalle.');
    }

  public function store(Request $request)
{
    Venta::create([
        'cod_venta' => 'V-' . rand(0000, 9999),
        'fecha_venta' => now(),
        'importe_bruto' => $request->input('importeBruto'),
        'igv' => $request->input('igv'),
        'importe_total' => $request->input('importeTotal'),
        'estado' => 1,
    ]);

    return redirect()->route('index.detalleVenta')->with('success', 'Venta registrada correctamente.');
}

    public function destroy($iddetalle)
    {
        $detalle = DetalleVenta::findOrFail($iddetalle);
        $detalle->update(['estado' => 0]);

        
        $this->recalcularTotalesActivos();

        return redirect()->route('index.venta')->with('success', 'Se eliminó correctamente');
    }

   
    private function recalcularTotalesActivos()
    {
        $detallesActivos = DetalleVenta::where('estado', 1)->get();

        // Si no hay productos activos, resetear totales
        if ($detallesActivos->isEmpty()) {
            DetalleVenta::query()->update([
                'importe_bruto' => 0,
                'igv' => 0,
                'importe_total' => 0,
            ]);
            return;
        }

        // Calcular totales
        $importeBruto = $detallesActivos->sum('subtotal_total');
        $igv = $importeBruto * 0.18;
        $importeTotal = $importeBruto + $igv;

        // Actualizar totales en todos los registros activos
        foreach ($detallesActivos as $item) {
            $item->update([
                'importe_bruto' => $importeBruto,
                'igv' => $igv,
                'importe_total' => $importeTotal,
            ]);
        }
    }
}
