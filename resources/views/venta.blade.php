@extends('layouts.app')
@section('title', 'Ventas')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card p-2">
                    <div class="card-body mt-4">
                        <div
                            class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start ">
                            <h5><b>CREAR Y VISUALIZAR VENTA</b></h5>
                            <a href="{{ route('index') }}" class="btn btn-primary" style="color: #fff">Ir a menú principal </a>
                        </div>

                        <div class="mt-4">

                            <form action="{{ route('ventas.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start">
                                    <div style="width: 45%">
                                        <label for="producto">Producto</label>
                                        <select class="form-control" id="producto" name="productoList" required>
                                            <option value="">Seleccione un producto</option>
                                            @foreach ($productos as $p)
                                                <option value="{{ $p->id }}" data-precio="{{ $p->precio_producto }}">
                                                    {{ $p->nombre_producto }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div style="width: 18%">
                                        <label for="descuentoProductoVenta" class="mb-2">
                                            Descuento (%)</label>
                                        <input type="number" step="1" min="0" class="form-control"
                                            placeholder="0" name="productoDescuento" id="descuentoProductoVenta">
                                    </div>

                                    <div style="width: 18%">
                                        <label for="cantProductoVenta" class="mb-2">
                                            Cantidad vendida</label>
                                        <input type="number" step="1" min="0" class="form-control"
                                            placeholder="0" name="productoCantidad" id="cantProductoVenta">
                                    </div>


                                    <div class="mt-4" style="width: 15%">
                                        <button type="submit" class="btn btn-primary">Añadir al detalle</button>
                                    </div>

                                </div>
                                <div class="mt-3 ">
                                    @error('productoList')
                                        <p class="alert alert-danger">Ingrese nombre de producto</p>
                                    @enderror

                                    @error('productoDescuento')
                                        <p class="alert alert-danger">Ingrese el descuento</p>
                                    @enderror

                                    @error('productoCantidad')
                                        <p class="alert alert-danger">Ingrese la cantidad</p>
                                    @enderror



                                </div>
                            </form>

                        </div>


                    </div>

                </div>

                <!-- Table-->
                <div class="card mt-4">
                    <div class="card-body mt-1">
                        <table class="table table-bordered table-hover w-100">
                            <thead>
                                <th class="text-center" style="width: 5%">#</th>
                                <th class="d-none text-center" style="width: 5%">ID</th>
                                <th class="text-center"style="width: 5%">Opciones</th>
                                <th class="text-center" style="width: 15%">Nombre</th>
                                <th class="text-center" style="width: 10%">Precio de Unitario</th>
                                <th class="text-center" style="width: 10%">Cantidad vendida</th>
                                <th class="text-center" style="width: 10%">Sueldo total bruto</th>
                                <th class="text-center" style="width: 10%">Descuento</th>
                                <th class="text-center" style="width: 10%">Subtotales</th>
                                <!-- total bruto, igv y total neto-->


                            </thead>
                            @foreach ($detalles as $detalle)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="d-none text-center">{{ $detalle->id }}</td>
                                    <form action="{{ route('ventas.delete', $detalle->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <td class="text-center"><button type="submit"
                                                class="btn btn-danger">Eliminar</button></td>
                                    </form>
                                    <td class="text-center">{{ $detalle->producto->nombre_producto }}</td>
                                    <td class="text-center">{{ $detalle->producto->precio_producto }}</td>
                                    <td class="text-center">{{ $detalle->cantidad }}</td>
                                    <td class="text-center">{{ $detalle->subtotal_bruto }}</td>
                                    <td class="text-center">{{ $detalle->descuento }}%</td>
                                    <td class="text-center">{{ $detalle->subtotal_total }}</td>

                                </tr>
                            @endforeach
                            <!-- Totales-->
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form action="{{ route('ventas.store') }} " method="POST">
                                        @csrf

                                        <!-- tu tabla -->
                                        <table class="table table-bordered table-hover w-100">
                                            <tr>
                                                <td class="text-center">TOTAL BRUTO:</td>
                                                <td class="text-center" style="width: 13%">
                                                    S/ {{ $detalles->last()->importe_bruto ?? 0 }}
                                                    <input type="hidden" name="importeBruto"
                                                        value="{{ $detalles->last()->importe_bruto ?? 0 }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">IGV (18%):</td>
                                                <td class="text-center" style="width: 13%">
                                                    S/ {{ $detalles->last()->igv ?? 0 }}
                                                    <input type="hidden" name="igv"
                                                        value="{{ $detalles->last()->igv ?? 0 }}">
                                                </td>
                                            </tr>
                                            <tr class="fw-bold">
                                                <td class="text-center">TOTAL NETO:</td>
                                                <td class="text-center text-success fs-5" style="width: 13%">
                                                    S/ {{ $detalles->last()->importe_total ?? 0 }}
                                                    <input type="hidden" name="importeTotal"
                                                        value="{{ $detalles->last()->importe_total ?? 0 }}">
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">Registrar Venta</button>
                                        </div>

                                    </form>



                                </div>
                            </div>
                        </table>
                        <!-- Totales-->

                    </div>
                </div>


            </div>
        </div>
    </div>




@endsection
