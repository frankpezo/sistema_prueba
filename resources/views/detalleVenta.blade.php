@extends('layouts.app')
@section('title', 'Detaller Ventas')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card p-2">
                    <div class="card-body mt-4">
                        <div
                            class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start ">
                            <h5><b>LISTA Y ANULAR VENTA</b></h5>
                            <a href="{{ route('index') }}" class="btn btn-primary" style="color: #fff">Ir a menú principal </a>
                        </div>


                        <div class="card mt-4">
                            <div class="card-body mt-1">
                                <table class="table table-bordered table-hover w-100">
                                    <thead>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th class="d-none text-center" style="width: 5%">ID</th>
                                        <th class="text-center" style="width: 15%">Número de documento</th>
                                        <th class="text-center" style="width: 10%">Importe bruto</th>
                                        <th class="text-center" style="width: 10%">IGV</th>

                                        <th class="text-center" style="width: 10%">Importe total</th>
                                        <th class="text-center"style="width: 10%">Opciones</th>



                                    </thead>
                                    @forelse ($ventas as $venta)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="d-none text-center">{{ $venta->id }}</td>
                                            <td class="text-center">{{ $venta->cod_venta }}</td>
                                            <td class="text-center">S/{{ number_format($venta->importe_bruto, 2) }}</td>
                                            <td class="text-center">S/{{ number_format($venta->igv, 2) }}</td>
                                            <td class="text-center">S/{{ number_format($venta->importe_total, 2) }}</td>

                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="" class="btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#detalleVentaModal">Visualizar</a>
                                                    <form id="deleteForm-{{ $venta->id }}"
                                                        action="{{ route('detalleVenta.delete', $venta->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger"
                                                            onclick="confirmDelete(event, {{ $venta->id }})">Anular</button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                    @endforelse
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- mdoal-->
    <div class="modal fade" id="detalleVentaModal" tabindex="-1" aria-hidden="true" aria-labelledby="label-modal-1"
        data-bs-backdrop="false">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="fs-5">Detalle venta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card border-0 shadow">
                        <div class="card-body">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        // Mensae de confirmación si se desea eliminar el producto
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success mx-2",
                cancelButton: "btn btn-danger mx-2"
            },
            buttonsStyling: false
        });

        function confirmDelete(event, productid) {
            event.preventDefault();

            swalWithBootstrapButtons.fire({
                title: '¿Seguro que desea eliminar?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario correspondiente
                    document.getElementById(`deleteForm-${productid}`).submit();
                }
            });
        }
    </script>
@endsection
