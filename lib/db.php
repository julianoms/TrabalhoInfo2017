<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of DB
 *
 * @author Juliano
 */
class DB {
    /**
     * @var \mysqli
     */
    protected $connection;
    
    /*
     * @var DB
     */
    protected static $instance;
    
    private function __construct($host, $user, $password, $db_name) {
        
        $this->connection = new \mysqli($host, $user, $password, $db_name);
        
        if(mysqli_connect_error()){
            throw new \Exception("Nao foi possivel conectar ao Banco de Dados. Erro: ". mysqli_connect_error().".");
        }
    }
        
    public static function getConnection() {
        if (self::$instance == NULL) {
            self::$instance = new DB(Config::get('db.host'), Config::get('db.user'), Config::get('db.password'), Config::get('db.name'));
        }
        
        return self::$instance->connection;
    }
    
    public static function close() {
        if (self::$instance != NULL) {
            if(self::$instance->connection){
                self::$instance->connection->close();
            }
        }
    }
}
