<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;

use Lib\App;
use Lib\Controller;
use Lib\Session;
use Lib\Router;
use Models\Funcionario;

/**
 * Description of FuncionarioController
 *
 * @author Juliano
 */
class FuncionarioController extends Controller{
      
    public function admin_login() {
        if(filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST'){
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            
            if($login == FALSE || $senha == FALSE){
                Session::setFlash('Todos os campos são obrigatórios.');
                Router::redirect(App::getRouter()->getUrl('funcionario', 'login', [], 'admin'));
            }
            
            $usuario = Funcionario::getByLogin($login);
            var_dump($usuario);
            
            if($usuario == NULL || password_verify($senha, $usuario->getSenha()) == FALSE){
                Session::setFlash('Não foi possível encontrar um usuário com os dados informados.');
            } else {
                Session::set('funcionario', $usuario);
            }
            
            Router::redirect(App::getRouter()->getUrl('', '', [], 'admin'));
        }
    }
    
    public function admin_logout() {
        Session::destroy();
        Router::redirect(App::getRouter()->getUrl('', '', [], 'admin'));
    }
    
    public function index() {
        if(filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST'){
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            
            if($login == FALSE || $senha == FALSE){
                Session::setFlash('Todos os campos são obrigatórios.');
                Router::redirect(App::getRouter()->getUrl('funcionario', 'index', [], ''));
            }
            
            $usuario = Funcionario::getByLogin($login);
            
            if($usuario == NULL || password_verify($senha, $usuario->getSenha()) == FALSE){
                Session::setFlash('Não foi possível encontrar um usuário com os dados informados.');
                Router::redirect(App::getRouter()->getUrl('funcionario', 'index', [], ''));
            } else {
                //var_dump($usuario); die();
                Session::set('funcionario', $usuario);
                Router::redirect(App::getRouter()->getUrl('produto', '', [], 'admin'));
            }
        }
                       
    }
    public function admin_index() {
        
        $this->data['funcionarios'] = Funcionario::getFuncionarios();       
    }
    
    public function admin_editar($id) {

        $request = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        
        if ($request === 'POST') {
            $idFuncionario = filter_input(INPUT_POST, 'idFuncionario', FILTER_SANITIZE_NUMBER_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $cargo = filter_input(INPUT_POST, 'cargo',FILTER_SANITIZE_STRING);
          

            if ($idFuncionario == FALSE || $idFuncionario <= 0) {
                
                Session::setFlash('Funcionario não encontrada.');
                Router::redirect(App::getRouter()->getUrl('funcionario'));
            } else if ($nome == FALSE || $usuario == FALSE ||$cargo == FALSE) {
                Session::setFlash('Todos os campos são obrigatórios.');
                Router::redirect(App::getRouter()->getUrl('funcionario', 'editar', [$idFuncionario]));
            }

            
            $funcionario = new Funcionario($idFuncionario, $nome, $usuario,$cargo, $disponivel);
            Produto::atualizar($funcionario);

            Session::flash('Funcionario atualizado com sucesso.');
            Router::redirect(App::getRouter()->getUrl('funcionario'));
        
            
        } else if ($request === 'GET') {
            $idFuncionario = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            if ($idFuncionario == FALSE || $idFuncionario < 0) {
                Session::setFlash('Funcionario não encontrado.');
                Router::redirect(App::getRouter()->getUrl('funcionario'));
            }

            $this->data['funcionario'] = Produto::getById($idFuncionario);
        }
    }
    public function admin_excluir($id) {

        $idFuncionario = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if ($idFuncionario == FALSE || $idFuncionario < 0) {
            Session::setFlash('Funcionario não encontrado.');
            Router::redirect(App::getRouter()->getUrl('funcionario'));
        }

        Funcionario::excluir($idFuncionario);
        Session::setFlash('Funcionario excluido com sucesso.');
        Router::redirect(App::getRouter()->getUrl('funcionario'));
    }
    public function admin_cadastro() {
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha',FILTER_SANITIZE_STRING);          
            $cargo = filter_input(INPUT_POST, 'cargo',FILTER_SANITIZE_STRING);  

            if ($nome == FALSE || $usuario == FALSE || $senha == FALSE ||$cargo == FALSE) {
                Session::setFlash('Todos os campos são obrigatórios.');
                Router::redirect(App::getRouter()->getUrl('funcionario', 'cadastro'));
                
            }
            
            $funcionario = new Funcionario(0, $nome, $usuario,$senha,$cargo);
            Funcionario::cadastrar($funcionario);
            
            Session::flash('Funcionario cadastrado com sucesso.');
            Router::redirect(App::getRouter()->getUrl('funcionario'));
        }
    }
}
