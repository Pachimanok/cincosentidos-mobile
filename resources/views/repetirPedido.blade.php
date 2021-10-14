
@extends('layouts.header')

        <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
        aria-controls="offcanvasExample">
        <i class="fa fa-bars p-4" style="font-size: x-large;color:#af3636"></i>
    </a>
    <div class="container pl-3">
        <div class="row g-3">
            <div class="col mx-auto">
                <h2 class="text-center">Resumen del Pedido a Repetir:</h2>
                @if($pedidosNo->isNotEmpty())
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div>
                        Para repetir este pedido no contamos con: 
                         @foreach($pedidosNo as $faltante)
                            {{ $faltante->cantidad}} cajas de {{ $faltante->titulo . ' ' .$faltante->sub_titulo}}  
                         @endforeach
                    </div>
                  </div>
                @else
                 <br class="mt-5">
                @endif
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-sm-5 mx-auto">
                <div class="card card-body p-0" style="border: none;">
                    <ul class="list-group list-group-flush">
                        @foreach ($pedidos as $pedido)
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="mx-auto">
                                    <p class="text-sm mt-0 mb-0">{{ $pedido->cantidad}} <small>{{ $pedido->titulo}} - {{ $pedido->sub_titulo}}</small></p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-auto mx-auto">
                                    <h6 style="color: #af3636;"> Subtotal:
                                        $ {{  $pedido->precio * $dto}}.00</h6>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        <form action="/pedido/{{$id}}" method="POST">
                            @method('PUT')
                            @csrf
                                <div class="row mt-5">
                                    <label for="select" style="color: #af3636;">Datos
                                        de facturacion:</label>
                                    <select class="form-control" id="campo"
                                        style="border-top: none !important;
                                        border-right: none;
                                        border-left: none;" name="facturacion[]">
                                        <option value="">Elegir</option>
                                        @foreach($facturacion as $facturacion)
                                            <option value="{{ $facturacion->id }}">{{ $facturacion->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mt-3">
                                    <label for="select" style="color: #af3636;">Datos
                                        de Entrega:</label>
                                    <select class="form-control" id="campo"
                                        style="border-top: none !important;
                                        border-right: none;
                                        border-left: none;" name="direccion[]">
                                        <option value="">Elegir</option>
                                        @foreach($direccion as $direccion)
                                            <option value="{{ $direccion->id }}">{{ $direccion->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mt-3">
                                    <label for="select" style="color: #af3636;">Modo
                                        de Pago:</label>
                                    <select class="form-control" id="campo"
                                        style="border-top: none !important;
                                        border-right: none;
                                        border-left: none;" name="pago[]">
                                        <option value="">Elegir</option>
                                        <option value="efectivo">Efectivo </option>
                                        <option value="transferencia">Transferencia</option>
                                        <option value="mercadoPago">Mercado Pago</option>
                                    </select>
                                </div>
                                <input type="hidden" value="{{$total}}" name="total">
                            
            

                    </ul>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger mt-5"
                        style="border-radius:50px; background: #af3636;">Pagar
                        $ {{ $total }},00 </button>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" style="max-width:
    60%;" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">

        <button type="button" class="btn-close text-reset"
            style="color:#af3636 !important;"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-sm-5 mx-auto">
                <div class="text-center">
                    <img src="assets/img/avatar.png" class="rounded
                        img-fluid" style="border-radius: 50% !important;
                        height:
                        4rem;">
                    <h6 class="mb-0" style="color:#af3636;margin-top:
                        4px;"> Juanjo Diaz</h6>
                    <p class="text-secondary" style="font-size: small;">juanjo@gmail.com</p>
                </div>
            </div>
        </div>
        <div>
            <div class="list-group mt-5">
                <a href="principal.html" class="list-group-item
                    list-group-item-action list-group-item-light"
                    style="border:none; display: flex; text-align:
                    center;">
                    <i class="fas fa-home" style="margin-right: 2rem;"></i>
                    <p>Inicio</p>
                </a>
                <a href="#" class="list-group-item
                    list-group-item-action list-group-item-light"
                    style="border:none; display: flex; text-align:
                    center;">
                    <i class="fas fa-file-invoice" style="margin-right:
                        2rem;"></i>
                    <p>Datos</p>
                </a>
                <a href="#" class="list-group-item
                    list-group-item-action list-group-item-light"
                    style="border:none; display: flex; text-align:
                    center;">
                    <i class="fas fa-bullhorn" style="margin-right:
                        2rem;"></i>
                    <p>Recomendar</p>
                </a>

            </div>
        </div>
    </div> 
</div>
@extends('layouts.footer')
