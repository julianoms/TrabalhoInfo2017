<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models;

use Lib\DB;
use Lib\Model;

/**
 * Description of pedido
 *
 * @author Juliano
 */
class Pedido extends Model {

    private $idPedido;
    private $nome;
    private $endereco;
    private $quantidade;
    /**
     *
     * @var Produto 
     */
    private $idProduto;

    public static function getPedidos() {
        $conn = DB::getConnection();

        $query = 'SELECT `idPedido`, `nome`, `endereco`, `quantidade`,`Produto_idProduto` FROM `pedido`';
        $result = $conn->query($query);

        if ($result === FALSE) {
            throw new \Exception("Falha ao carregar lista de pedidos. Erro: {$conn->error}");
        }

        $pedidos = [];
        while ($row = $result->fetch_assoc()) {
            $pedidos[] = new Pedido($row['idPedido'], $row['nome'], $row['endereco'], $row['quantidade'],$row['Produto_idProduto']);
        }

        $result->close();

        return $pedidos;
    }

    public static function insere($pedido) {
        $conn = DB::getConnection();

        $query = 'INSERT INTO `pedido` (`nome`, `endereco`, `quantidade`,`Produto_idProduto`) VALUES (?,?,?,?)';
        $stmt = $conn->prepare($query);

        if ($stmt === FALSE) {
            throw new \Exception("Falha ao preparar a query. Erro: {$conn->error}");
        }
        
        $nome = $pedido->getNome();
        $endereco = $pedido->getEndereco();
        $quantidade = $pedido->getQuantidade();
        $idProduto = $pedido->getIdProduto()->getIdProduto();        
        
        
        if ($stmt->bind_param('ssii', $nome, $endereco, $quantidade,$idProduto) === FALSE) {
            throw new \Exception("Falha ao associar parametros. Erro: {$stmt->error}");
        }

        if ($stmt->execute() === FALSE) {
            throw new \Exception("Falha ao executar a query. Erro: {$stmt->error}");
        }

        $stmt->close();
    }
    function getIdPedido() {
        return $this->idPedido;
    }

    function getNome() {
        return $this->nome;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    /**
     * 
     * @return Produto
     */
    function getIdProduto(){
        return $this->idProduto;
    }
    function setIdProduto(Produto $idProduto) {
        $this->idProduto = $idProduto;
    }

    function __construct($idPedido, $nome, $endereco, $quantidade,$idProduto) {
        $this->idPedido = $idPedido;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->quantidade = $quantidade;
        $this->idProduto = $idProduto;
    }

}
