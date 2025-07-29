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

<div>
    <form action="{{ route('login.create') }}" method="POST" style="display: flex; flex-direction: column; width: 10%;">
        @csrf

        <label for="firstname">Nome</label>
        <input type="text" name="firstname" id="firstname">

        <label for="lastname">Sobrenome</label>
        <input type="text" name="lastname" id="lastname">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Senha</label>
        <input type="password" name="password" id="password">

        <div>
            <a href="{{ route('login.form') }}">Login</a>
            <button type="submit">Registrar-se</button>
        </div>

    </form>
</div>



<script>
    $(document).ready(() => {
        setTimeout(() => {
            $('#container-mensagem').fadeOut();
        }, 2000);
    });
</script>
