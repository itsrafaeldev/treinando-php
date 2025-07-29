@extends('layouts.main')
@section('title', 'Lista Produtos')
@section('conteudo')


@if ($mensagem = Session::get('erro'))
    <div class="card red lighten-2" id="container-mensagem">
        <div class="card-content white-text">
            <span class="card-title">Erro</span>
            <p>{{ $mensagem }}</p>
        </div>
    </div>
@endif

@if ($errors->any())

@foreach ($errors->all() as $error)
    <div class="card red lighten-2" id="container-mensagem">
        <div class="card-content white-text">
            <span class="card-title">Erro</span>
            <p>{{ $error }}</p>
        </div>
    </div>
@endforeach

@endif

<form action="{{ route('login.auth') }}" method="POST">
    @csrf

    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <label for="password">Senha</label>
    <input type="password" name="password" id="password">
    <button type="submit">Entrar</button>
    {{-- <a href="#">Entrar</a> --}}
</form>

<script>
    $(document).ready(() => {
        setTimeout(() => {
            $('#container-mensagem').fadeOut(); // esconde a div após 3 segundos
        }, 2000); // 3000ms = 3 segundos
    });
</script>

@endsection
