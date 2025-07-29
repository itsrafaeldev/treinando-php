<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Import JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <!-- JSZip (usado para exportação no DevExtreme) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- DevExtreme JS -->
    <script src="https://cdn3.devexpress.com/jslib/23.2.5/js/dx.all.js"></script>

    <!-- CSS do DevExtreme -->
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.2.5/css/dx.light.css">

    {{-- Icones do Materialize --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .options {
            padding: 20px;
            background-color: rgba(191, 191, 191, 0.15);
            margin-top: 20px;
        }

        .option {
            margin-top: 10px;
        }

        .caption {
            font-size: 18px;
            font-weight: 500;
        }

        .option>label {
            margin-right: 10px;
        }

        .option>.dx-selectbox {
            display: inline-block;
            vertical-align: middle;
        }
    </style>


</head>

<body>


    <nav class="purple darken-2">
        <div class="nav-wrapper container">
            <a href="{{ route('home') }}" class="brand-logo center">CursoLaravel</a>
            <ul id="nav-mobile" class="left">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>
                    <a href="" class="dropdown-trigger" data-target="dropdown1">
                        Categorias
                        <i class="material-icons right">expand_more</i>
                    </a>

                </li>
                <li><a href="{{ route('carrinho') }}">
                        <span class="material-icons">shopping_cart</span>
                        <span class="new badge blue" data-badge-caption>{{ \Cart::content()->count() }}</span></a></li>
            </ul>
            @auth
                <ul id="nav-mobile" class="right">
                    <li>
                        <a href="#" class="dropdown-trigger" data-target="dropdown2">
                            Olá {{ auth()->user()->firstname }}!
                            <i class="material-icons right">expand_more</i>
                        </a>
                </ul>
            @else
                <ul id="nav-mobile" class="right">
                    <li>
                        <a href="{{ route('login.form') }}">
                            Login
                            <i class="material-icons right">login</i>
                        </a>
                </ul>
            @endauth
        </div>
    </nav>

    @yield('conteudo')

    <!-- Dropdown Structure -->
    <ul id='dropdown1' class='dropdown-content'>
        @foreach ($categoriasMenu as $categoria)
            <li><a href="{{ route('categorias.produtos', $categoria->id) }}">{{ $categoria->nome }}</a></li>
        @endforeach
    </ul>
    <ul id='dropdown2' class='dropdown-content'>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('login.logout') }}">Sair</a></li>

    </ul>



    {{-- SCRIPTS --}}

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script defer>
        $('.dropdown-trigger').dropdown({
            coverTrigger: false, // Faz o menu aparecer fora do botão
            constrainWidth: false // Permite o dropdown ter largura diferente do botão
        });
    </script>


</body>

</html>
