<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Loja Online - @yield('title')</title>
    </head>
    <body>
        <div>
            <p>Obrigado pela sua compra.</p>
            <p>Para ativar o produto insira a seguinte chave:</p>
            <p><strong>{{ $key }}</strong></p>
        </div>

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>