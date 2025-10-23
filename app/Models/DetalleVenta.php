<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVenta extends Model
{
    protected $fillable = [
       'id_producto', 
        'cantidad',
        'precio_unitario',
        'subtotal_bruto',
        'descuento',
        'subtotal_total',
        'importe_bruto',
        'igv',
        'importe_total', 
        'estado'
        
    ];

    //Relación
    public function  producto(): BelongsTo{
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function venta(): BelongsTo{
        return $this->belongsTo(Venta::class,  'id_venta');
    }
}
