<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'cod_venta',
        'fecha_venta',
        'importe_bruto',
        'igv',
        'importe_total',
        'estado'
    ];

  //Relación 
  public function productos(){
        return $this->belongsToMany(Producto::class, 'detalle_ventas', 'id_producto', 'id_venta')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal_bruto', 'descuento', 'subtotal_total');
  }

  public function detalles()
{
    return $this->hasMany(DetalleVenta::class, 'id_venta');
}



}
