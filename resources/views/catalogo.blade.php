@extends('layouts.header')
<a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
    <i class="fa fa-bars p-4" style="font-size: x-large;color:#af3636"></i>
</a>
<div class="container pl-3">
    <form action="pedido" method="POST">
    @csrf    
    <div class="row g-3">
        <div class="col">
            <h2 class="text-center">NUESTROS PRODUCTOS</h2>
        </div>
    </div>
    <div class="card-group row row-cols-2 m-4" style="font-family: 'STIX Two Text', serif;">
       
        @foreach ($productos as $producto)
            <div class="card" style="height: fit-content; border: none;">
                <div class="row row-cols-2">
                    <div class="col-md-4 p-0">
                        <img src="{{ asset('assets/img/' . $producto->imagen) }}" class="img-fluid rounded-start"
                            alt="...">
                    </div>
                    <div class="col-md-8 p-0">
                        <div class="card-body p-0">
                            <h5 class="card-title text-uppercase mb-0" style="font-size: x-small; color:#a58f5c">
                                {{ $producto->titulo }}</h5>
                            <h6 class="card-title text-uppercase mb-0" style="font-size: xx-small; color:#8b888b">
                                {{ $producto->sub_titulo }} </h6>
                            <span style="background: #a58f5c; color:white; font-weight: 700; font-size:small;"> <i
                                    style="margin: 0.4rem;">{{ $producto->descuento * 100 }}% OFF </i> </span>
                            <h4 class="card-title text-uppercase" style="font-size: small; color:#8b888b">
                                <i>${{ $producto->precio / $producto->descuento }}.00 <span
                                        style="text-decoration:line-through; font-size:x-small;">$
                                        {{ $producto->precio }}</span></i></h4>
                            <p class="card-text mb-0" style="font-size: xx-small;">{{ $producto->detalle }}</p>
                            <input type="number" class="form-control text-center" name="cantidad[{{ $producto->id }}]"
                                placeholder="0" style="border:none;" min="0">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-danger mb-5 mt-5"
            style="border-radius:50px; background: #af3636;">PEDIR</a>
    </div>
    </form>
</div>

    @extends('layouts.footer')
