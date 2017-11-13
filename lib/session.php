<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of Session
 *
 * @author Juliano
 */
class Session {

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }
    
    public static function get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
    }
    
    public static function delete($key){
        if (isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }
    
    public static function setFlash($message){
        Session::set('flash_message',$message);
    }
    
    public static function hasFlash(){
        return !is_null(Session::get('flash_message'));
    }
    
    public static function flash(){
        if(Session::hasFlash()){
            echo Session::get('flash_message');
            Session::delete('flash_message');
        }
    }
    
    public static function destroy () {
        session_destroy();
    }
    
}
