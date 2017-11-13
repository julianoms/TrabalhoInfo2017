<?php
    /* @var $produto Models\Produto */
    $produto = $data['produto'];
?>

<h3>Editar Produto</h3>
<form method="POST" action="">
    <input type="hidden" name="idProduto" value="<?= $produto->getIdProduto() ?>"/>
    <div class="form-group">
        <label for="titulo">Nome do Produto</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?= $produto->getNome() ?>" placeholder="Nome"/>         
    </div>
    <div class="form-group">
        <label for="titulo">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control" value="" placeholder="Descriçao"><?= $produto->getDescricao() ?> </textarea>         
    </div>
    <div class="form-group">
        <label for="titulo">Valor</label>
        <textarea name="valor" id="valor" class="form-control" value="" placeholder="Valor"><?= $produto->getValor() ?> </textarea>         
    </div>
    <div class="form-group">
        <input type="checkbox" name="disponivel" id="disponivel" <?= ($produto->getDisponivel() ? 'checked=""' : '') ?>/>
        <label for="publicado">Disponível</label>
    </div>    

    <input type="submit" class="btn btn-sucess" value="Editar"/>
</form>