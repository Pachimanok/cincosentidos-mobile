@extends('layouts.header')

@php
// SDK de Mercado Pago
require base_path('/vendor/autoload.php');
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-1782908899890379-092218-82bf271f7189f4eb1668ac84bc73f0ea-33894200');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = $detalle;
$item->quantity = 1;
$item->unit_price = $total;
$preference->items = array($item);

$preference->back_urls = array(
    "success" => "http://127.0.0.1:8000/mp/$id",
    "failure" => "http://127.0.0.1:8000/home",
    "pending" => "http://127.0.0.1:8000/home"
);
$preference->auto_return = "approved";
$preference->save();

@endphp
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    // Agrega credenciales de SDK
      const mp = new MercadoPago('TEST-624bfaab-1ca5-4d31-853b-c3e09a2b1849', {
            locale: 'es-AR'
      });
    
      // Inicializa el checkout
      const checkout = mp.checkout({
          preference: {
              id: '{{$preference->id}}'
          },
          autoOpen: true,
          
    });
    </script>
    

@extends('layouts.footer')

