<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
    <!--este archivo (layout) es una plantilla de laravel util
    para la reutilizacion de codigo y mantener la consistencia
    en las distintas vistas que se creen-->
<body>
    <!--contenedor de la seccion content en la cual se coloca
    el contenido especifico de las vistas cada vez que se use
    la plantilla-->
    <div class='container'>
        @yield('content')
    </div>
</body>
</html>