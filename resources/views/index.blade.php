@extends('layouts.app')
@section('title', 'Inicio de panel')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body mt-4">
                        <h1>Panel de Administración</h1>


                        <div d-flex=inline-block
                            style="background-color: rgb(169, 219, 254); padding: 20px; margin-top: 20px;">
                            <p class="text-primary"><a href="{{ route('index.productos') }}"
                                    style="text-decoration:none">Productos</a></p>
                            <p class="text-primary"><a href="{{ route('index.venta') }}"
                                    style="text-decoration:none">Registros de ventas</a>
                            </p>
                            <p class="text-primary"><a href="{{ route('index.detalleVenta') }}"
                                    style="text-decoration:none">Visualización de
                                    ventas</a></p>

                        </div>

                    </div>
                </div>



            </div>
        </div>
    @endsection
