
@extends('layouts.header')

<script>
    window.onload = info;
    function info(){
                swal("¡{{$nombre}} Hemos registrado tu pago correctamente!", "", "success");
                window.location.href = "/home";              
              }
</script>

@extends('layouts.footer')
