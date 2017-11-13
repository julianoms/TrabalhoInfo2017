<?php
/* @var $produto Models\Produto */
$produto = $data['produto'];
?>

<div class="card h-100" align ="center">
    <a href="#" ><img class="card-img-top" src="/mercado/webroot/static/img/<?=$produto->getIdProduto()?>.jpg" alt="" width="40%"></a>
        <div class="card-body">
            <h4 class="card-title" align ="center">
                <a><?= $produto->getNome()?></a>
            </h4>
        <p class="card-text" align ="center">
        	<?= $produto->getDescricao()?><br>
        	<?= ($produto->getValor())?>
        </p>
    </div>
</div>

<br/>
<div align ="center">
    <a href="<?= Lib\App::getRouter()->getUrl('pedido', 'index',[$produto->getIdProduto()]) ?>"
        class="btn btn-sm btn-success"> Pedir Produto
    </a> 
</div>