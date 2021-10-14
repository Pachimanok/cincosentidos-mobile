@extends('layouts.header')

<img src="http://rail.com.ar/50OFF.gif" alt="" class="img-fluid">
<div class="container pl-3 mt-4 ">
    <div class="d-grid gap-2">
        <a href="/catalogo" class="btn btn-danger mb-5 mt-5" style="border-radius:50px; background: #af3636;">HACER UN
            PEDIDO</a>
    </div>
    <div class="row g-3">
        <div class="col">
            <h2 class="text-center text-dark">Últimos pedidos</h2>
        </div>
    </div>
    @if ($qp >= 1)
        @foreach ($pedidos as $pedido)
            <div class="card" style=" border: none;
            box-shadow: -2px 12px 25px -10px rgba(0,0,0,0.55);
            -webkit-box-shadow: -2px 12px 25px -10px rgba(0,0,0,0.55);
            -moz-box-shadow: -2px 12px 25px -10px rgba(0,0,0,0.55);border-radius: 10px 10px 10px 10px;
            margin-bottom:1rem;
            ">
                <div class="d-flex" style="background:#af3636; border-radius: 10px 10px 0 0;">
                    <div class="col align-middle">
                        <h5 class="text-white mt-2" style="margin-left: 1rem;"> Pedido #00{{ $pedido->id }}</h5>
                    </div>
                    <div class="col text-center">
                        <small class="text-white">
                            <p class="text-white  "
                                style="text-align:right; margin-right:.5rem; margin-top:.7rem !important;">
                                @if ($pedido->estado == 'comprado')
                                    <span class="badge bg-warning text-warning align-middle"
                                        style="padding: 1px 5px; border-radius: 50%; margin-right:4px">.</span>
                                    Solicitado
                                @elseif($pedido->estado == 'facturado')<span
                                        class="badge bg-success text-success align-middle"
                                        style="padding: 1px 5px; border-radius: 50%; margin-right:4px">.</span>En
                                    Preparacion
                                @elseif($pedido->estado == 'SolicitadoDespacho')<span
                                    class="badge bg-info text-info align-middle"
                                    style="padding: 1px 5px; border-radius: 50%; margin-right:4px">.</span>Prepadado
                                @elseif($pedido->estado == 'enviado')<span
                                        class="badge bg-info text-info align-middle"
                                        style="padding: 1px 5px; border-radius: 50%; margin-right:4px">.</span>En camino
                                @else<span
                                class="badge bg-secondary text-secondary align-middle"
                                style="padding: 1px 5px; border-radius: 50%; margin-right:4px">.</span>Terminada
                                @endif
                            </p>
                        </small>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text mb-1"><small class="text-muted">Pediste:
                            @foreach ($detalles as $detalle)
                                @if ($pedido->id == $detalle->id_pedido)
                                    {{ $detalle->cantidad }} {{ $detalle->producto }} -
                                    {{ $detalle->sub_titulo }},
                                @endif
                            @endforeach
                        </small>
                    </p>
                    <p><small class="text-muted">Seguimiento: <span
                                id="p2">{{ $pedido->seguimiento }}</span></small>
                    </p>
                    <div class="d-flex">
                        <div class="col text-center">
                            <button class="btn" style="color: #af3636;
                    " onclick="copiarAlPortapapeles('p2')" @if ($pedido->seguimiento == null) disabled @endif><i
                                    class="fas fa-shipping-fast"></i> Seguir pedido</button>
                        </div>
                        <div class="col">
                            <a href="pedido/{{ $pedido->id }}" class="btn " style="color:#af3636;border-left: 1px;
                        border: #d4c6c6;
                        border-left-style: solid;"><i class="fas fa-redo-alt" style="margin-right:4px;"></i> Repetir
                                Pedido<a>
                        </div>
                    </div>

                </div>
            </div>

        @endforeach
        <div class="col-sm-5 mx-auto text-center mb-3">
            <button type="button" class="btn btn-outline-danger" >ver mas pedidos</button>
        </div>
    @else

        <div class="card" style=" border: none;
                box-shadow: -2px 12px 25px -10px rgba(0,0,0,0.55);
                -webkit-box-shadow: -2px 12px 25px -10px rgba(0,0,0,0.55);
                -moz-box-shadow: -2px 12px 25px -10px rgba(0,0,0,0.55);border-radius: 10px 10px 10px 10px;
                margin-bottom:1rem;
                ">

            <div class="card-body text-center">
                <img src="{{ asset('assets/img/no-data.svg') }}" alt="" style="height: 5rem;" class="img-fluid">
                <p class="text-center text-secondary">Aun no has realizado pedidos</p>
            </div>
        </div>

    @endif
</div>



</div>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" style="max-width:
            60%;" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">

        <button type="button" class="btn-close text-reset" style="color:#af3636 !important;" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-sm-5 mx-auto">
                <div class="text-center">
                    <img src="assets/img/5s.png" class="rounded
                                img-fluid" style=";
                                height:
                                4rem;">
                    <h6 class="mb-0" style="color:#af3636;margin-top:
                                4px;"> {{ $name }}</h6>
                    <p class="text-secondary" style="font-size: small;">{{ $email }}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="list-group mt-5">
                <a href="principal.html"
                    class="list-group-item
                            list-group-item-action list-group-item-light"
                    style="border:none; display: flex; text-align:
                            center;">
                    <i class="fas fa-home" style="margin-right: 2rem;"></i>
                    <p>Inicio</p>
                </a>
                <a href="#"
                    class="list-group-item
                            list-group-item-action list-group-item-light"
                    style="border:none; display: flex; text-align:
                            center;">
                    <i class="fas fa-file-invoice" style="margin-right:
                                2rem;"></i>
                    <p>Facturacion</p>
                </a>
                <a href="#"
                    class="list-group-item
                            list-group-item-action list-group-item-light"
                    style="border:none; display: flex; text-align:
                            center;">
                    <i class="fas fa-file-invoice" style="margin-right:
                                2rem;"></i>
                    <p>Lugares de entrega</p>
                </a>
                <a href="#"
                    class="list-group-item
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

<script>
    function copiarAlPortapapeles(id_elemento) {
        var aux = document.createElement("input");
        aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
        window.open('http://www.andesmarcargas.com/seguimiento.html', '_blank');
    }
</script>
@extends('layouts.footer')
