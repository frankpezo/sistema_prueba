<?php

use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

//Panel
Route::get('/', [IndexController::class, 'index'])->name('index');

//Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('index.productos');
Route::post('/productos/create', [ProductoController::class, 'create'])->name('create.productos');
Route::get('/productos/edit/{idproducto}', [ProductoController::class, 'show'])->name('edit.productos');
Route::put('/productos/update/{idproducto}', [ProductoController::class, 'update'])->name('update.productos');
Route::delete('/productos/delete/{idproducto}', [ProductoController::class, 'destroy'])->name('delete.productos');


//Venta
Route::get('/venta', [VentaController::class, 'index'])->name('index.venta');
Route::post('/venta/create', [VentaController::class, 'create'])->name('ventas.create');
Route::delete('/venta/delete/{iddetalle}', [VentaController::class, 'destroy'])->name('ventas.delete');
Route::post('/venta/store', [VentaController::class, 'store'])->name('ventas.store');

//Detalle venta
Route::get('detalle_venta', [DetalleVentaController::class, 'index'])->name('index.detalleVenta');
Route::delete('/detalle_venta/delete/{idventa}', [DetalleVentaController::class, 'destroy'])->name('detalleVenta.delete');
