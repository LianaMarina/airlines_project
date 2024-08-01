<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public\css\bootstrap.css') }}">
    {{-- Иконки Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>@yield('title')</title>
</head>

<body>
    <style>
        button:focus {
            border: none !important;
        }

        button:active {
            border: none !important;
        }

        h1 {
            font-size: 64px;
            color: white;
        }

        h2 {
            font-size: 40px;
            font-weight: 300;
        }

        input[type=text],
        input[type=email],
        input[type=date],
        input[type=phone],
        input[type=password] {
            border: none;
            border-bottom: 1px solid #0000003d;
            border-radius: 0;
            font-weight: 100;
        }

        input[type=checkbox] {
            border: 1px solid #0000003d;
        }

        label {
            font-weight: 300;
        }

        textarea:focus,
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="datetime"]:focus,
        input[type="datetime-local"]:focus,
        input[type="date"]:focus,
        input[type="month"]:focus,
        input[type="time"]:focus,
        input[type="week"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="url"]:focus,
        input[type="search"]:focus,
        input[type="tel"]:focus,
        input[type="color"]:focus,
        input[type="phone"]:focus,
        input[type="checkbox"]:focus,
        .uneditable-input:focus {
            border-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(255, 255, 255, 0.6);
            outline: 0 none;
        }

        input[type="checkbox"]:focus {
            border: 1px solid #0000003d;
        }

        input[type="checkbox"]:active {
            background-color: #5B4A66;
        }

        input[type="checkbox"]:checked {
            background-color: #5B4A66;
            border: none;
        }

        .big-button {
            border-radius: 50px;
            padding: 10px 0px;
            background-color: #5B4A66;
            border: none;
            box-shadow: 5px 10px 5px rgba(0, 0, 0, 0.219);
            color: white;
            font-weight: 500;
            transition: transform 0.2s;
        }

        .big-button:hover {
            background-color: #4b3658;
            color: white;
            transform: translateY(-5px);
        }

        .button {
            transition: transform 0.2s;
        }

        .button:hover {
            background-color: #4b3658;
            color: white;
            transform: translateY(-5px);
        }

        .btn-edit {
            background-color: #828F65;
        }

        .btn-edit:hover {
            background-color: rgb(79, 99, 41);
        }

        .btn-delete {
            background-color: #78556A;
        }

        .btn-delete:hover {
            background-color: #74335a;
        }

        .title {
            overflow: hidden;
        }

        .title:before,
        .title:after {
            content: '';
            display: inline-block;
            vertical-align: middle;
            box-sizing: border-box;
            width: 100%;
            height: 1px;
            background: #00000056;
            border: solid #FFF;
            border-width: 0 10px;
        }

        .title:before {
            margin-left: -100%;
        }

        .title:after {
            margin-right: -100%;
        }

        /* КАРТОЧКИ-РЕЙСЫ */
        .simple-linear {
            background: linear-gradient(#f02d9f5b, #2825d446);
            border-radius: 10px;
        }
    </style>
    <script src="{{ asset('public\js\bootstrap.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.5/vue.global.js"></script>

    @include('layout.navbar')

    @yield('content')

</body>

</html>
