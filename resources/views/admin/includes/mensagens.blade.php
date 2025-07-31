@if ($mensage = Session::get('sucesso'))
    <div class="card green" id="container-mensagem">
        <div class="card-content white-text">
            <span>{{ $mensage }}</span>
        </div>
    </div>
@endif


