<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;

use Lib\Controller;
use Models\Pedido;
use Models\Produto;
use Lib\Session;
use Lib\Router;
use Lib\App;

/**
 * Description of ContatoController
 *
 * @author Juliano
 */
class PedidoController extends Controller {

    public function index($idProduto) {

        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === "POST") {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
            //$idProduto = filter_input(INPUT_POST, 'idProduto', FILTER_SANITIZE_NUMBER_INT);
            $idProduto = filter_var($idProduto, FILTER_SANITIZE_NUMBER_INT);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);
            
            //var_dump($idProduto);die();
            if ($nome == FALSE || $endereco == FALSE || $quantidade == FALSE) {
                Session::setFlash('Todos os campos são obrigatorios');
            } else {
                if(($Produto = Produto::getProdutoPorId($idProduto))!= FALSE){
                    $pedido = new Pedido(0, $nome, $endereco, $quantidade,$Produto);
                    Pedido::insere($pedido);
                
                    Session::setFlash('Pedido Realizado com Sucesso');
                }else{
                    Session::setFlash('Produto nao encontrado, selecione um produto');
                    Router::redirect(App::getRouter()->getUrl('produto', '', [], ''));
                }
            }
        }
    }
    
    public function admin_index() {
        $this->data['pedidos'] = Pedido::getPedidos();
    }

}
