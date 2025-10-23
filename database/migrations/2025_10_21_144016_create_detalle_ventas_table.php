<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            //LLave foránea
             $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id')->on('productos')->nullable()->onDelete('restrict');

            /*  $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('ventas')->nullable()->onDelete('restrict'); */

            //campos
            $table->integer('cantidad');
            $table->decimal('precio_unitario',10,2);
            $table->decimal('subtotal_bruto',10,2);
            $table->decimal('descuento', 10, 2)->default(0.00);
            $table->decimal('subtotal_total',10,2);
            //segunda tabla ventas
           $table->decimal('importe_bruto', 10, 2)->default(0);
$table->decimal('igv', 10, 2)->default(0);
$table->decimal('importe_total', 10, 2)->default(0);

             $table->tinyInteger('estado')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_detalle_ventas');
    }
};
