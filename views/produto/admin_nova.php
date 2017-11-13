<h3>Novo Produto</h3>
<form method="POST" action="">
    <div class="form-group">
        <label for="titulo">Nome do Produto</label>
        <input type="text" name="nome" id="nome" class="form-control" value="" placeholder="Nome"/>         
    </div>
    <div class="form-group">
        <label for="titulo">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control" value="" placeholder="Descrição"></textarea>         
    </div>
    <div class="form-group">
        <label for="titulo">valor</label>
        <textarea name="valor" id="valor" class="form-control" value="" placeholder="Valor"></textarea>         
    </div>
    <div class="form-group">
        <input type="checkbox" name="Disponivel" id="disponivel" checked=""/>
        <label for="Disponivel">Disponível</label>
    </div>
    <input type="submit" class="btn btn-success" value="Criar"/>
</form>