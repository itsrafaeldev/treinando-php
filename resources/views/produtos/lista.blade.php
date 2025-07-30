@extends('layouts.main')
@section('title', 'Lista Produtos')
@section('conteudo')


    <div class="row container">

        @foreach ($produtos as $produto)
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img id="imagem-produto" src="{{ $produto->imagem }}">
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


        <div class="row center">{{ $produtos->links('layouts.paginacao-menu') }}</div>
        <form action="">
            <label for="">Lançar Taxa</label>
            <input type="text" id="input">
            <button type="button" id="btn-lancar">Lançar</button>
        </form>

        <div id="gridContainer"></div>
        <button id="salvar">Salvar</button>
    </div>





    <script>
        DevExpress.localization.locale(navigator.language || navigator.browserLanguage);

        $(document).ready(() => {
            $("#gridContainer").dxDataGrid({
                dataSource: [{
                        id: 1,
                        nome: 'Casa',
                        descricao: 'Descricao 1',
                        // Amount: 1740,
                        // PaymentDate: '2013/01/06',
                    },
                    {
                        // PaymentId: 2,
                        // ContactName: 'Construção',
                        // CompanyName: 'ElectrixMax',
                        // Amount: 850,
                        // PaymentDate: '2013/01/13',
                        id: 2,
                        nome: 'Construcao',
                        descricao: 'Descricao 2',
                    },
                    {
                        // PaymentId: 3,
                        // ContactName: 'Janet Leverling',
                        // CompanyName: 'Video Emporium',
                        // Amount: 2235,
                        // PaymentDate: '2013/01/07',\
                        id: 3,
                        nome: 'Papelaria',
                        descricao: 'Descricao 3',
                    },
                ],
                scrolling: {
                    useNative: true,
                },
                paging: {
                    enabled: false,
                },
                headerFilter: {
                    visible: true,
                    search: 'enable',
                },
                columnAutoWidth: true,
                showBorders: true,
                showColumnLines: true,
                showRowLines: true,
                selection: {
                    mode: "multiple",
                    showCheckBoxesMode: "always",
                },
                columnChooser: {
                    enabled: true,
                    mode: "select",
                },
                allowColumnResizing: true,
                allowColumnReordering: true,
                columns: [

                    "nome",
                    "descricao"
                ],
                onContentReady: function(e) {
                    const dados = e.component.getDataSource().items();
                    console.log('Dados COMPLETOS do dataSource:', dados);
                }
            });

        });

        $('#btn-lancar').click(() => {
            var gridInstance = $("#gridContainer").dxDataGrid('instance')

            var selecionados = gridInstance.getSelectedRowsData();
            console.log("Selecionados:", selecionados);
            var valorInput = $('#input').val()

            $.each(selecionados, (index, item) => {
                item.nome = valorInput
            })

            $("#gridContainer").dxDataGrid("instance").refresh();

            $('#input').val('');

        });


        $("#salvar").on("click", function() {
            const gridInstance = $("#gridContainer").dxDataGrid("instance");
            const dados = gridInstance.getDataSource().items();
            // Enviar para Laravel via AJAX
            $.ajax({
                url: '/salvar-dados',
                type: 'POST',
                // data: JSON.stringify({
                //     dados: dados
                // }),
                data: JSON.stringify({
                    usuarios: [{
                        nome: 'Rafael',
                        email: '30/07/2025',
                        idade: 30
                    },
                    {
                        nome: 'Maria',
                        email: '29/07/2025',
                        idade: 25
                    },
                    {
                        nome: 'João',
                        email: '30/07/2025',
                        idade: 18
                    }]
                }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    alert('Salvo com sucesso!');
                },
                error: function(err) {
                    console.error(err);
                    alert('Erro ao salvar!');
                }
            });
        });
    </script>
@endsection
