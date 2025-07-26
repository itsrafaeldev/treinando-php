@extends('layouts.main')
@section('title', 'Detalhes Produto')
@section('conteudo')


    <div class="row container mt-2 ">

        <div class="col s12 m6">
            <img src="{{ $produto->imagem }}" class="responsive-img" alt="Imagem produto">
        </div>
        <div class="col s12 m6">
            <h4>{{ $produto->nome }}</h4>
            <h5>Preço: R${{ number_format($produto->preco, 2, ',', '.') }}</h5>
            <p>{{ $produto->descricao }}</p>
            <p>Publicado por: {{ $produto->user->firstname }}</p>
            <p>Categoria: {{ $produto->categoria->nome }}</p>

            <form action="{{ route('carrinho.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $produto->id }}">
                <input type="hidden" name="name" value="{{ $produto->nome }}">
                <input type="hidden" name="price" value="{{ $produto->preco }}">
                <input type="number" name="qnt" value="1">
                <input type="hidden" name="img" value="{{ $produto->imagem }}">
                <button class="btn btn-large purple accent-3">Comprar</button>
            </form>
        </div>
    </div>


@endsection
