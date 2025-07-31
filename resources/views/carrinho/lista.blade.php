@extends('layouts.main')
@section('title', 'Carrinho de Compras')
@section('conteudo')





    <div class="row container">
        @if ($mensage = Session::get('sucesso'))
            <div class="card green" id="container-mensagem">
                <div class="card-content white-text">
                    <span class="card-title">Parabéns</span>
                    <p>{{ $mensage }}</p>
                </div>
            </div>
        @endif

        @if ($mensage = Session::get('aviso'))
            <div class="card yellow darken-2" id="container-mensagem">
                <div class="card-content white-text">
                    <span class="card-title">Aviso!</span>
                    <p>{{ $mensage }}</p>
                </div>
            </div>
        @endif

        <h5>Seu carrinho possui: {{ $itens->count() }} produtos.</h5>

        @if ($itens->count() == 0)
        <div class="card orange lighten-2">
                <div class="card-content white-text">
                    <span class="card-title">Seu carrinho está Vazio.</span>
                    <p>Aproveite nossas promoções!!!</p>
                </div>
            </div>
        @else
            <table class="striped table text-center">
                <thead>
                    <tr>
                        <th style="text-align: center;">Produto</th>
                        <th style="text-align: center;">Nome do Produto</th>
                        <th style="text-align: center;">Preço</th>
                        <th style="text-align: center;">Quantidade</th>
                        {{-- <th style="text-align: center;">Ação</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($itens as $item)
                        <tr>
                            <td style="text-align: center;"><img src="{{ $item->options->image }}" alt=""
                                    width="70" class="responsive-img circle"></img></td>
                            <td style="text-align: center;">{{ $item->name }}</td>
                            <td style="text-align: center;">R${{ number_format($item->price, 2, ',', '.') }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('carrinho.atualizar') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input style="width: 40px; text-align: center;"type="number" name="qty"
                                        id='input-qty'
                                        value="{{ is_array($item->qty) ? $item->qty['value'] : $item->qty }}" min="1">
                                    <input type="hidden" value="{{ $item->rowId }}" name="id">
                                    <button class="btn-floating waves-effect waves-light purple darken-2"><i
                                            class="material-icons" id="btn-atualizar">refresh</i></button>
                                </form>
                                <form action="{{ route('carrinho.remover') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $item->rowId }}" name="id">
                                    <button class="btn-floating waves-effect waves-light red"><i
                                            class="material-icons">delete</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="card purple lighten-2" >
                <div class="card-content white-text">
                    <span class="card-title">Total:</span>
                    <h5><strong>R${{ $total }}</strong></h5>
                </div>
            </div>

        @endif


        <div class="row container center">
            <a href="{{ route('home') }}" class="btn-large waves-effect waves-light purple darken-2">
                Continuar Comprando
                <i class="material-icons right">add_shopping_cart</i>
            </a>
            <a href="{{ route('carrinho.limpar') }}" class="btn-large waves-effect waves-light purple darken-2">
                Limpar Carrinho
                <i class="material-icons right">clear</i>
            </a>
            <button class="btn-large waves-effect waves-light purple darken-2">
                Finalizar Pedido
                <i class="material-icons right">check</i>
            </button>
        </div>
        {{-- <div class="row center">{{ $produtosPorCategoria->links('layouts.paginacao-menu') }}</div> --}}

    </div>

    <script>
        $(document).ready(() => {
            setTimeout(() => {
                $('#container-mensagem').fadeOut(); // esconde a div após 3 segundos
            }, 2000); // 3000ms = 3 segundos
        });
    </script>

@endsection
