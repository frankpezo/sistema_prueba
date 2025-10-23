<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
   
    protected $fillable = [
        'nombre_producto',
        'precio_producto',
        'stock_producto',
        'estado',
    ];
   
    //Relaciones
    public function ventas(): BelongsToMany{
        return $this->belongsToMany(Venta::class, 'detalle_ventas', 'id_producto', 'id_venta')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal_bruto', 'descuento', 'subtotal_total');
    }

}
