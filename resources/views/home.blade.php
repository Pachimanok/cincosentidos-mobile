@extends('layouts.header')

<img src="http://rail.com.ar/50OFF.gif" alt="" class="img-fluid">
<div class="container pl-3 mt-4 ">
    <div class="d-grid gap-2">
        <a href="/catalogo" class="btn btn-danger mb-5 mt-5"
            style="border-radius:50px; background: #af3636;">HACER UN PEDIDO</a>
    </div>
    <div class="row g-3">
        <div class="col">
            <h2 class="text-center text-dark">Últimos pedidos</h2>
        </div>
    </div>
    <div class="row mt-2">
        <h6 class="card-title" style="color:#af3636; ">Pedido 20/8/2021 <span class="badge rounded-pill"
                style="background:#af3636; ">Repetir Pedido</span></h6>
        <p class="card-text mb-1"><small class="text-muted">El viñatero | Reserve 2021</small></p>
        <div class="col-sm-8 mx-auto">
            <hr class="mt-2 mb-2">
        </div>

    </div>
    <div class="row mt-2">
        <h6 class="card-title" style="color:#af3636; ">Pedido 20/8/2021 <span class="badge rounded-pill"
                style="background:#af3636; ">Repetir Pedido</span></h6>
        <p class="card-text mb-1"><small class="text-muted">El viñatero | Reserve 2021</small></p>
        <div class="col-sm-8 mx-auto">
            <hr class="mt-2 mb-2">
        </div>

    </div>
    <div class="row mt-2">
        <h6 class="card-title" style="color:#af3636; ">Pedido 20/8/2021 <span class="badge rounded-pill"
                style="background:#af3636; ">Repetir Pedido</span></h6>
        <p class="card-text mb-1"><small class="text-muted">El viñatero | Reserve 2021</small></p>
        <div class="col-sm-8 mx-auto">
            <hr class="mt-2 mb-2">
        </div>

    </div>
    <div class="row mt-2">
        <h6 class="card-title" style="color:#af3636; ">Pedido 20/8/2021 <span class="badge rounded-pill"
                style="background:#af3636; ">Repetir Pedido</span></h6>
        <p class="card-text mb-1"><small class="text-muted">El viñatero | Reserve 2021</small></p>
        <div class="col-sm-8 mx-auto">
            <hr class="mt-2 mb-2">
        </div>

    </div>
    <div class="row mt-2">
        <h6 class="card-title" style="color:#af3636; ">Pedido 20/8/2021 <span class="badge rounded-pill"
                style="background:#af3636; ">Repetir Pedido</span></h6>
        <p class="card-text mb-1"><small class="text-muted">El viñatero | Reserve 2021</small></p>
        <div class="col-sm-8 mx-auto">
            <hr class="mt-2 mb-2">
        </div>

    </div>
    <div class="col-sm-5 mx-auto text-center">
        <button type="button" class="btn btn-outline-danger" style="border:none;" >ver mas</button>
    </div>


</div>
</div>
<a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
    <i class="fa fa-bars p-4" style="font-size: x-large;color:#af3636"></i>
</a>
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
                <a href="principal.html" class="list-group-item
                            list-group-item-action list-group-item-light" style="border:none; display: flex; text-align:
                            center;">
                    <i class="fas fa-home" style="margin-right: 2rem;"></i>
                    <p>Inicio</p>
                </a>
                <a href="#" class="list-group-item
                            list-group-item-action list-group-item-light" style="border:none; display: flex; text-align:
                            center;">
                    <i class="fas fa-file-invoice" style="margin-right:
                                2rem;"></i>
                    <p>Facturacion</p>
                </a>
                <a href="#" class="list-group-item
                            list-group-item-action list-group-item-light" style="border:none; display: flex; text-align:
                            center;">
                    <i class="fas fa-file-invoice" style="margin-right:
                                2rem;"></i>
                    <p>Lugares de entrega</p>
                </a>
                <a href="#" class="list-group-item
                            list-group-item-action list-group-item-light" style="border:none; display: flex; text-align:
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
