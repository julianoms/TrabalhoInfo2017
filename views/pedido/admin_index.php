<h3>Pedidos</h3>

<table class="table table-hover" style="width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>quantidade</th>
            <th>Id do produto</th>
        </tr>
    </thead>
    <tbody>       
        <?php 
        /* @var $pedido Models\Mensagens */
        foreach ($data['pedidos'] as $pedido): ?>
            <tr>
                <td><?= $pedido->getIdPedido() ?></td>
                <td><?= $pedido->getNome() ?></td>
                <td><?= $pedido->getEndereco() ?></td>
                <td><?= $pedido->getQuantidade() ?></td>
                <td><?= $pedido->getIdProduto() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>    
</table>
