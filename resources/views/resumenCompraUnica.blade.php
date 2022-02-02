@extends('layouts.header')

<div class="container pl-3 mt-5" style="font-family: 'Montserrat', sans-serif;">
    <div class="row g-3">
        <div class="col mx-auto">
            <h2 class="text-center">Resumen del Pedido</h2>
            <h6 class="text-center" style="color:#a58f5c ">ID: #0000{{ $id }}</h6>
        </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-5 mx-auto">
            <div class="card card-body p-0" style="border: none;">
                <ul class="list-group list-group-flush">
                    @foreach ($detalle as $articulo)
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="mx-auto">
                                    <p class="text-sm mt-0 mb-0">{{ $articulo->cantidad }}
                                        <small>{{ $articulo->producto }}</small></p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-auto mx-auto">
                                    <h6 style="color: #af3636;"> Subtotal:
                                        ${{ $articulo->precio }},00</h6>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <form action="/pedido/{{ $id }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row mt-3">
                            <h4 class="text-center">DATOS PARA FACTURACION:</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mx-auto">
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Razón Social:
                                </h6>
                                <input id="text" type="text" class="form-control email-login"
                                    placeholder="Mi Empresa SA" name="razon_social" value="{{ old('text') }}" required
                                    autocomplete="text">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 mx-auto">
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">CUIT:
                                </h6>
                                <input id="cuit" type="number" class="form-control password" placeholder="30715400220"
                                    name="cuit" value="{{ old('cuit') }}" required autocomplete="cuit">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 mx-auto">
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Condicion Fiscal:
                                </h6>
                                <select name="cond_fiscal[]" class="form-control"
                                    style="border-left:none; border-right:none; border-top:none;" id="">
                                    <option value="" style="color:gray;">-.seleccionar.-</option>
                                    <option value="Exento">Exento</option>
                                    <option value="Presupuesto">Presupuesto</option>
                                    <option value="Consumidor Final">Consumidor Final</option>
                                    <option value="Responsable Inscripto">Responsable Inscripto</option>
                                    <option value="Responsable Monotributo">Responsable Monotributo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <h4 class="text-center">DATOS PARA ENTREGA :</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mx-auto" >
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Calle:
                                </h6>
                                <input id="text" type="text" class="form-control email-login"
                                    placeholder="Av. San Martin" name="calle" value="{{ old('text') }}" required
                                    autocomplete="text">
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="col-sm-4 text-center" style="padding-right: 1rem; ">
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">número:
                                </h6>
                                <input id="numero" type="number" class="form-control password" placeholder="3345"
                                    name="numero" value="{{ old('numero') }}" required autocomplete="numero">
                            </div>
                            <div class="col-sm-4 text-center">
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Piso:
                                </h6>
                                <input id="piso" type="text" class="form-control password" placeholder="8" name="piso"
                                    value="{{ old('piso') }}" autocomplete="piso">
                            </div>
                            <div class="col-sm-4 text-center" >
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Dpto:
                                </h6>
                                <input id="dpto" type="text" class="form-control password" placeholder="A" name="dpto"
                                    value="{{ old('dpto') }}" autocomplete="dpto">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 mx-auto">
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Provincia:
                                </h6>
                                <input id="provincia" type="text" class="form-control email-login" placeholder="Mendoza"
                                    name="provincia" value="{{ old('provincia') }}" required
                                    autocomplete="provincia">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 mx-auto" >
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Localidad:
                                </h6>
                                <input id="localidad" type="text" class="form-control email-login" placeholder="Maipú"
                                    name="localidad" value="{{ old('localidad') }}" required
                                    autocomplete="localidad">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 mx-auto" >
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Código Postal:
                                </h6>
                                <input id="codigoPostal" type="text" class="form-control email-login" placeholder="5515"
                                    name="codigoPostal" value="{{ old('codigoPostal') }}" required
                                    autocomplete="codigoPostal">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 mx-auto" >
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Teléfono de Contacto:
                                </h6>
                                <input id="telContacto" type="text" class="form-control email-login"
                                    placeholder="(261)2128105" name="telContacto" value="{{ old('telContacto') }}"
                                    required autocomplete="telContacto">
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-12 mx-auto" >
                                <h6 style="text-align: left; margin-bottom:
                                            0%; padding-left: 3%; color:#af3636;">Alguna referencia:
                                </h6>
                                <input id="referencia" type="text" class="form-control email-login"
                                    placeholder="Es el porton negro" name="referencia"
                                    value="{{ old('referencia') }}" autocomplete="referencia">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="select" style="color: #af3636;">Modo
                                de Pago:</label>
                            <select class="form-control" id="campo" style="border-top: none !important;
                            border-right: none;
                            border-left: none;" name="pago[]" required>
                                <option value="">Elegir</option>
                                <option value="transferencia">Transferencia</option>
                                <option value="mercadoPago">Mercado Pago</option>
                            </select>
                        </div>
                        <input type="hidden" value="{{ $precio }}" name="total">

                </ul>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="unica" value="unica" class="btn btn-danger mt-5"
                    style="border-radius:50px; background: #af3636;">Pagar
                    $ {{ $precio }},00 </button>
            </div>
            </form>
        </div>
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
                <a href="principal.html"
                    class="list-group-item
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
                    <p>Datos</p>
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
