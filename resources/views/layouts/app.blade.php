<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Recursos Humanos - @yield('title') </title>


    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />


</head>
<body>

    <div id="app">
        <app></app>
    </div>

    <script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>

</body>
</html>
