
@extends('layouts.header')

        <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
        aria-controls="offcanvasExample">
        <i class="fa fa-bars p-4" style="font-size: x-large;color:#af3636"></i>
    </a>
    <div class="container pl-3">
        <div class="row g-3">
            <div class="col mx-auto">
                <h2 class="text-center">Resumen del Pedido</h2>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-sm-5 mx-auto">
                <div class="card card-body p-0" style="border: none;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="mx-auto">
                                    <p class="text-sm mt-0 mb-0">2 <small>EL
                                            VINATERO Malbec x6 bot.</small></p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-auto mx-auto">
                                    <h6 style="color: #af3636;"> Subtotal:
                                        $5.280,00</h6>
                                </div>
                            </div>

                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="mx-auto">
                                    <p class="text-sm mt-0 mb-0">6 <small>Reserva
                                            Malbec x6 bot.</small></p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-auto mx-auto">
                                    <h6 style="color: #af3636;"> Subtotal:
                                        $28.080,00</h6>
                                </div>
                            </div>
                        </li>
                        <form action="">
                            <div class="row mt-5">
                                <label for="select" style="color: #af3636;">Datos
                                    de facturacion:</label>
                                <select class="form-control" id="campo"
                                    style="border-top: none !important;
                                    border-right: none;
                                    border-left: none;">
                                    <option value="">Elegir</option>
                                    <option value="">La Empresa SA</option>
                                    <option value="">Juan Ramos</option>
                                </select>
                            </div>
                            <div class="row mt-3">
                                <label for="select" style="color: #af3636;">Datos
                                    de Entrega:</label>
                                <select class="form-control" id="campo"
                                    style="border-top: none !important;
                                    border-right: none;
                                    border-left: none;">
                                    <option value="">Elegir</option>
                                    <option value="">Oficina </option>
                                    <option value="">Domicilio</option>
                                </select>
                            </div>
                            <div class="row mt-3">
                                <label for="select" style="color: #af3636;">Modo
                                    de Pago:</label>
                                <select class="form-control" id="campo"
                                    style="border-top: none !important;
                                    border-right: none;
                                    border-left: none;">
                                    <option value="">Elegir</option>
                                    <option value="">Efectivo </option>
                                    <option value="">Transferencia</option>
                                    <option value="">Mercado Pago</option>
                                </select>
                            </div>
                        </form>

                    </ul>
                </div>
                <div class="d-grid gap-2">
                    <a href="checkout.html" class="btn btn-danger mt-5"
                        style="border-radius:50px; background: #af3636;">Pagar
                        $ 33.360,00 </a>
                </div>


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
