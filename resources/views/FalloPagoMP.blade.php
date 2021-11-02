
@extends('layouts.header')

<script>
     window.onload = info;
    function info(){
                swal("¡{{$nombre}} no pudimos procesar el pago!", "No te preocupes, tu pedido está tomado! En breves alguien de administración se comunicará para solucionarlo!", "warning");
                window.location.href = "/home";              
              }
</script>

@extends('layouts.footer')
