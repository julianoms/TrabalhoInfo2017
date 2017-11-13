<!-- Page Content -->
    <div class="container">
      <div class="row">
        <?php foreach ($data['produtos'] as $produto): ?>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
              <a href="#"><img class="card-img-top" src="/mercado/webroot/static/img/<?=$produto->getIdProduto()?>.jpg" alt="" width="100%"></a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="<?= Lib\App::getRouter()->getUrl('produto', 'ver', [$produto->getIdProduto()]) ?>"><?= $produto->getNome()?></a>
              </h4>
              <p class="card-text"><?= $produto->getDescricao()?></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->