<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models;

use Lib\DB;

/**
 * Description of funcionario
 *
 * @author Juliano
 */
class Funcionario {    
    private $idFuncionario;
    private $nome;
    private $usuario;
    private $senha;
    private $cargo;
    
    public static function getFuncionarios() {
        
        $conn = DB::getConnection();

        $query = 'SELECT `idFuncionario`, `nome`, `usuario`, `cargo` FROM `funcionario`';
        
        $result = $conn->query($query);
        
        if ($result === FALSE) {
            throw new \Exception("Falha ao carregar lista de Funcionarios. Erro: {$conn->error}");
        }

        $funcionarios = [];
        while ($row = $result->fetch_assoc()) {
            $funcionarios[] = new Funcionario($row['idFuncionario'], $row['nome'], $row['usuario'],'*****',$row['cargo']);
        }

        $result->close();
        //var_dump($funcionarios);
        return $funcionarios;
    }
    
    public static function getByLogin($login){
        
        $conn = DB::getConnection();
                                                                                                    
        $query = 'SELECT `idFuncionario`, `nome`, `usuario`, `senha`, `cargo` FROM `funcionario` WHERE `usuario` = ?';
        
        $stmt = $conn->prepare($query);
        
        if($stmt === FALSE){
            throw new \Exception("Falha ao preparar a query. Erro: {$conn->error}");
        }
               
        if($stmt->bind_param('s', $login) === FALSE){
            throw new \Exception("Falha ao associar parametros. Erro: {$stmt->error}");
        }
        
        if($stmt->execute() === FALSE){
            throw new \Exception("Falha ao executar a query. Erro: {$stmt->error}");
        }
        
        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()){
            $funcionario = new Funcionario($row['idFuncionario'], $row['nome'], $row['usuario'], $row['senha'], $row['cargo']);
        }else{
            $funcionario=NULL;
        }
        
        $result->close();
        $stmt->close();
        
        return $funcionario;
    }
    
    public static function getById($id){
        $conn = DB::getConnection();
        
        $query = 'SELECT `idFuncionario`, `nome`, `usuario`, `senha`, `cargo` FROM `funcionario` WHERE `idFuncionario` = ?';
        $stmt = $conn->prepare($query);
        if ($stmt == FALSE) {
            throw new \Exception("Falha ao carregar lista de páginas. Erro: {$conn->error}");
        }
        
        if ($stmt->bind_param('i', $id) === FALSE) {
            throw new \Exception("Falha ao associar parâmetros. Erro: {$stmt->error}");
        }
        
        if ($stmt->execute() == FALSE) {
            throw new \Exception("Falha ao executar query. Erro: {$stmt->error}");
        }
        
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $usuario = new Funcionario($row['idFuncionario'], $row['nome'], $row['usuario'], $row['senha'], $row['cargo']);
        } else {
            $usuario = NULL;
        }
        
        $result->close();
        $stmt->close();
        
        return $usuario;
    }
    public static function atualizar($funcionario) {
        $conn = DB::getConnection();

        $query = 'UPDATE `funcionario` SET `nome` = ?, `usuario` = ?, `cargo` = ? WHERE `idFuncionario` = ?';
        $stmt = $conn->prepare($query);

        if ($stmt == FALSE) {
            throw new \Exception("Falha ao preparar query. Erro: {$conn->error}");
        }

        $idFuncionario = $funcionario->getIdFuncionario();
        $nome = $funcionario->getNome();
        $usuario = $funcionario->getUsuario();
        $cargo = $funcionario->getCargo();
        

        if ($stmt->bind_param('sssi', $nome, $usuario, $cargo, $idFuncionario) === FALSE) {
            throw new \Exception("Falha ao associar parâmetros. Erro: {$stmt->error}");
        }
        
        if ($stmt->execute() === FALSE) {
            throw new \Exception("Falha ao executar query. Erro: {$stmt->error}");
        }

        $stmt->close();
    }
    public static function excluir($idFuncionario) {
        $conn = DB::getConnection();

        $query = 'DELETE FROM `funcionario` WHERE `idFuncionario` = ?';
        $stmt = $conn->prepare($query);

        if ($stmt == FALSE) {
            throw new \Exception("Falha ao preparar query. Erro: {$conn->error}");
        }

        if ($stmt->bind_param('i', $idFuncionario) === FALSE) {
            throw new \Exception("Falha ao associar parâmetros. Erro: {$stmt->error}");
        }

        if ($stmt->execute() === FALSE) {
            throw new \Exception("Falha ao executar query. Erro: {$stmt->error}");
        }

        $stmt->close();
    }
    public static function cadastrar($funcionario) {
        $conn = DB::getConnection();

        $query = 'INSERT INTO `funcionario` (`nome`, `usuario`, `senha`, `cargo`) VALUES (?, ?, ?, ?)';
        $stmt = $conn->prepare($query);

        if ($stmt == FALSE) {
            throw new \Exception("Falha ao preparar query. Erro: {$conn->error}");
        }

        $nome = $funcionario->getNome();
        $usuario = $funcionario->getUsuario();
        $senha = password_hash($funcionario->getSenha(), PASSWORD_DEFAULT);
        $cargo = $funcionario->getCargo();

        
        if ($stmt->bind_param('ssss', $nome, $usuario, $senha, $cargo) === FALSE) {
            throw new \Exception("Falha ao associar parâmetros. Erro: {$stmt->error}");
        }

        if ($stmt->execute() === FALSE) {
            throw new \Exception("Falha ao executar query. Erro: {$stmt->error}");
        }

        $stmt->close();
    }

    
    function getIdFuncionario() {
        return $this->idFuncionario;
    }

    function getNome() {
        return $this->nome;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function getCargo() {
        return $this->cargo;
    }

    function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }


    function __construct($idFuncionario, $nome, $usuario, $senha, $cargo) {
        $this->idFuncionario = $idFuncionario;
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->cargo = $cargo; 
    
    }

    
}
