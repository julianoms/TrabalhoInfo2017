<h3>Funcionarios</h3>
<table class="table table-striped" style="width: 400px;">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Usuario</th>
            <th>Cargo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['funcionarios'] as $funcionario): ?>
            <tr>
                <td>  <?= $funcionario->getIdFuncionario() ?> </td>
                <td>  <?= $funcionario->getNome() ?> </td>
                <td>  <?= $funcionario->getUsuario() ?> </td>
                <td>  <?= $funcionario->getCargo() ?> </td>
                <td class="text-right"> 
                    
                    <a href="<?= Lib\App::getRouter()->getUrl('funcionario', 'editar', [$funcionario->getIdFuncionario()]) ?>"
                       class="btn btn-sm btn-primary"> Editar
                    </a></p>
                    <a href="<?= Lib\App::getRouter()->getUrl('funcionario', 'excluir', [$funcionario->getIdFuncionario()]) ?>"
                       class="btn btn-sm btn-danger"
                       onclick="return confirmaExcluir()"> Excluir
                    </a>
                   
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br/>
<div>
    <a href="<?= Lib\App::getRouter()->getUrl('funcionario', 'cadastro') ?>"
        class="btn btn-sm btn-success"> Cadastrar funcionario
    </a> 
</div>