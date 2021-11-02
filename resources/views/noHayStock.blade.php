
@extends('layouts.header')

<script>
     window.onload = info;
    function info(){
                swal("No se puede repetir el pedido", "No pudimos repetir el pedido, por favor ingresa en nuestro catalogo y seleccioná nuevamente", "warning");
                window.location.href = "/home";              
              }
</script>

@extends('layouts.footer')
