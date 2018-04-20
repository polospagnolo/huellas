<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>403 - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #002B5D;
            color: #fff;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            margin-top: -25px;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .btn {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            padding: 10px;
            background-color: #e3e3e3;
            border-radius: 20px;

        }

        #logo {
            padding: 150px 0 0 0;
            text-align: center;
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<img src="{{asset('logo_banderas.png')}}" alt="" id="logo">
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <code>403</code>No puedes realizar esta acción
        </div>
        <a href="{{route('home')}}" class="btn">VOLVER</a>
    </div>
</div>
</body>
</html>
