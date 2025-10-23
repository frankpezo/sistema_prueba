@extends('layouts.app')
@section('title', 'Productos')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card p-2">
                    <div class="card-body mt-4">
                        <div
                            class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start ">
                            <h5><b>EDITAR PRODUCTO</b></h5>
                            <a href="{{ route('index.productos') }}" class="btn btn-primary" style="color: #fff">Volver a
                                productos</a>
                        </div>

                        <div class="mt-4 ">
                            <form action=" {{ route('update.productos', $productos->id) }} " method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div
                                    class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start">
                                    <div style="width: 45%">
                                        <label for="nombreProducto" class="mb-2">Nombre el producto</label>
                                        <input type="text" class="form-control" placeholder="Nombre del producto"
                                            name="productoNombreEdit" id="nombreProducto"
                                            value="{{ $productos->nombre_producto }}">
                                    </div>

                                    <div style="width: 18%">
                                        <label for="precioProducto" class="mb-2">
                                            Precio</label>
                                        <input type="number" step="0.01" min="0" class="form-control"
                                            placeholder="S/" name="productoPrecioEdit" id="precioProducto"
                                            value="{{ $productos->precio_producto }}">
                                    </div>

                                    <div style="width:
                                            18%">
                                        <label for="stockProducto" class="mb-2">
                                            Stock</label>
                                        <input type="number" step="1" min="0" class="form-control"
                                            placeholder="0" name="productoStockEdit" id="stockProducto"
                                            value="{{ $productos->stock_producto }}">

                                    </div>


                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-warning">Editar
                                            producto</button>
                                    </div>

                                </div>
                                <div class="mt-3 ">
                                    @error('productoNombreEdit')
                                        <p class="alert alert-danger">Ingrese nombre de producto</p>
                                    @enderror

                                    @error('productoPrecioEdit')
                                        <p class="alert alert-danger">Ingrese el precio de producto</p>
                                    @enderror

                                    @error('productoStockEdit')
                                        <p class="alert alert-danger">Ingrese el stock de producto</p>
                                    @enderror

                                </div>
                            </form>


                        </div>


                    </div>

                </div>


                <!-- Table-->
                {{--    <div class="card mt-4">
                    <div class="card-body mt-1">
                        <table class="table table-bordered table-hover w-100">
                            <thead>
                                <th class="text-center" style="width: 5%">#</th>
                                <th class="d-none text-center" style="width: 10%">ID</th>
                                <th class="text-center" style="width: 30%">Nombre</th>
                                <th class="text-center" style="width: 20%">Stock actual</th>
                                <th class="text-center" style="width: 20%">Precio de venta</th>
                                <th class="text-center"style="width: 30%">Opciones</th>
                            </thead>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="d-none text-center">{{ $producto->id }}</td>
                                    <td class="text-center">{{ $producto->nombre_producto }}</td>
                                    <td class="text-center">{{ $producto->stock_producto }}</td>
                                    <td class="text-center">{{ $producto->precio_producto }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="" class="btn btn-warning">Editar</a>
                                            <a href="" class="btn btn-danger">Eliminar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>


    <script>
        //Para editar
    </script>
@endsection
