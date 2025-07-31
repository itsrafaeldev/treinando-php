 <!-- Modal Structure -->
 <div id="create" class="modal">
     <div class="modal-content">
         <h4><i class="material-icons">mode_edit</i> Editar produto</h4>
         <form class="col s12" action="{{ route('admin.produto.store') }}" method="POST" enctype="multipart/form-data">
             @csrf

             <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

             <div class="row">
                 <div class="input-field col s6">
                     <input name="nome" id="name" type="text" class="validate">
                     <label for="name">Nome</label>
                 </div>
                 <div class="input-field col s6">
                     <input id="preco" type="number" class="validate" name="preco">
                     <label for="preco">Preço</label>
                 </div>
                 <div class="input-field col s12">
                     <input id="descricao" type="text" class="validate" name="descricao">
                     <label for="descricao">Descrição</label>
                 </div>

                 <div class="input-field col s12">
                     <select name="id_categoria">
                         <option value="" disabled selected>Escolha uma categoria</option>
                         @foreach ($categorias as $categoria)
                             <option value={{ $categoria->id }}> {{ $categoria->nome }}</option>
                         @endforeach
                     </select>
                     <label>Categoria</label>
                 </div>

                 <div class="file-field input-field col s12">
                     <div class="btn">
                        <span>Imagem</span>
                         <input name="imagem"type="file">
                     </div>
                     <div class="file-path-wrapper">
                         <input class="file-path validate" type="text">
                     </div>
                 </div>

             </div>

             <a href="#!" class="modal-close waves-effect waves-green btn blue right">Cancelar</a>
             <button type="submit" class="waves-effect waves-green btn green right">Cadastrar</button>

     </div>

     </form>
 </div>
