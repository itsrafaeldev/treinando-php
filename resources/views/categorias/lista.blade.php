@extends('layouts.main')
@section('title', 'Lista Produtos Por Categoria')
@section('conteudo')



    <div class="row container">
        <h5>Categoria: {{ $categoria->nome }}</h5>
        @foreach ($produtosPorCategoria as $produto)
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">

                        <img src="{{ $produto->imagem }}">

                        <a href="{{ route('produtos.details', $produto->slug) }}"
                            class="btn-floating halfway-fab waves-effect waves-light red"><i
                                class="material-icons">visibility</i></a>
                    </div>
                    <div class="card-content">
                        <span class="card-title">{{ $produto->nome }}</span>
                        <p>{{ \Str::limit($produto->descricao, 20) }}</p>

                    </div>
                </div>
            </div>
        @endforeach


        <div class="row center">{{ $produtosPorCategoria->links('layouts.paginacao-menu') }}</div>

    </div>
@endsection
