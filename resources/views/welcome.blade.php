@extends('layouts.header')
<div class="container">
    <div class="d-flex">
        <div class="col-sm-5 mx-auto">
            <div class="card" style="border:none; text-align: center;">
                <div class="row">
                   
                    <div class="col-sm-5 mx-auto mt-5 mb-3">
                        <h4 style="color: black; " class="mt-5">¡Bienvenido!</h4>
                        <img src="assets/img/5s.png" class="card-img-top
                                    img-fluid mb-5 mt-2 " style="width: 12rem;" alt="..."><br>
                    </div>
                   
                </div>
                
                    <div class="row mt-2">
                        <div class="col-md-8 mx-auto">
                            <a href="/home" class="btn btn-primary btn-login" style="border-radius:50px;width: 100%; background: #af3636;
                            color: white;">
                                Ingresar
                            </a>
                            <a href="/register" class="btn btn-primary btn-login mt-3" style="border-radius:50px;width: 100%; background: #af3636;
                            color: white;">
                                Registrarme
                            </a>
                            <a type="submit" class="btn btn-outline-secondary mt-3" style="border-radius:50px;width: 100%;">
                                compra unica
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@extends('layouts.header')
