<?php
    /* @var $funcionario Models\funcionario */
    $funcionario = $data['funcionario'];
?>

<h3>Editar Funcionario</h3>
<form method="POST" action="">
    <input type="hidden" name="idFuncionario" value="<?= $funcionario->getIdFuncionario() ?>"/>
    <div class="form-group">
        <label for="titulo">Nome do funcionario</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?= $funcionario->getNome() ?>" placeholder="Nome"/>         
    </div>
    <div class="form-group">
        <label for="titulo">Usuario</label>
        <textarea name="usuario" id="descricao" class="form-control" value="" placeholder="Usuario"><?= $funcionario->getUsuario() ?> </textarea>         
    </div>
    <div class="form-group">
        <label for="titulo">Cargo</label>
        <textarea name="cargo" id="valor" class="form-control" value="" placeholder="Cargo"><?= $funcionario->getCargo() ?> </textarea>         
    </div>
    <input type="submit" class="btn btn-sucess" value="Editar"/>
</form>