<?php

namespace Lib;

/**
 * Description of router
 *
 * @author Juliano
 */

/**
 * Classe resolvedora de URLs 
 */
class Router {

    protected $controller; //variavel guarda qual controller é chamado
    protected $action; //variavel guarda qual action é chamada 
    protected $route; //variavel guarda se vai ser admin
    protected $methodPrefix;
    protected $language;
    protected $params;
    
    function getParams() {
        return $this->params;
    }

    function setParams($params) {
        $this->params = $params;
    }

        function getController() {
        return $this->controller;
    }

    function getAction() {
        return $this->action;
    }

    function getRoute() {
        return $this->route;
    }

    function getMethodPrefix() {
        return $this->methodPrefix;
    }

    function getLanguage() {
        return $this->language;
    }

    function setController($controller) {
        $this->controller = $controller;
    }

    function setAction($action) {
        $this->action = $action;
    }

    function setRoute($route) {
        $this->route = $route;
    }

    function setMethodPrefix($methodPrefix) {
        $this->methodPrefix = $methodPrefix;
    }

    function setLanguage($language) {
        $this->language = $language;
    }

    protected function parseFriendlyUri($routes, $uri) {
        $uri_parts = explode('?', $uri);
        $path = $uri_parts[0]; 
        $path_parts = explode('/', $path); 

        $path_parts = array_reverse($path_parts); 

        // Idioma
        $language = end($path_parts);
        if($language != FALSE && in_array($language, Config::get('languages'))) {
            $this->language = $language;
            array_pop($path_parts);
        }

        // Route
        $route = end($path_parts);
        if ($route != FALSE && isset($routes[$route])) {
            $this->route = $route;
            $this->methodPrefix = $routes[$route];
            array_pop($path_parts);
        }

        // Controller
        $module = end($path_parts);
        if ($module != FALSE) {
            $this->controller = strtolower($module);
            array_pop($path_parts);
        }

        // Action
        $action = end($path_parts);
        if ($action != FALSE) {
            $this->action = strtolower($action);
            array_pop($path_parts);
        }

        return array_reverse($path_parts);
    }

    function __construct() {
        //carrega as urls padroes

        $routes = Config::get('routes');
     
        $this->route = Config::get('default_route');
        $this->methodPrefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');
        $this->language = Config::get('default_languages'); 
        
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
        $uri = substr($uri, strlen(Config::get('base_uri'))); 
        $this->params = $this->parseFriendlyUri($routes, $uri);

//        
//        $route = filter_input(INPUT_GET, 'route', FILTER_SANITIZE_STRING);
//        if ($route != FALSE && isset($routes[$route])) {
//           // echo "OI : " . $route; die();
//            $this->route = $route;
//            $this->methodPrefix = $routes[$route];
//        }
//        //controller
//        $module = filter_input(INPUT_GET, 'module', FILTER_SANITIZE_STRING);
//        if ($module != FALSE) {
//            $this->controller = strtolower($module);
//        }
//        //action
//        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
//        if ($action != FALSE) {
//            $this->action = strtolower($action);
//        }
//        //language
//        $lang = filter_input(INPUT_GET, 'lang', FILTER_SANITIZE_STRING);
//        if ($lang != FALSE && in_array($lang, Config::get('Languages'))) {
//            $this->language = $lang;
//        }

//         echo "Route: {$this->getRoute()} </br>"
//          . "Prefix: {$this->getMethodPrefix()} </br>"
//          . "Controller: {$this->getController()} </br>"
//          . "Action: {$this->getAction()} </br>"
//          . "Language: {$this->getLanguage()}  </br>"; 
    }

    public static function redirect($url) {
        header("location:$url");
        exit();
    }
    
    //gerador de URLs
    public function getUrl($module = '', $action = '', $params = [], $route = '', $lang = '') {
        
        //carrega a lista de rotas
        $routes = Config::get('routes');
        
        if($lang == '' || in_array($lang, Config::get('languages')) == FALSE) {
            $lang = $this->language;
        }
        
        if($route == '' && $this->route != Config::get('default_route')) {
            $route = $this->route;
        } else if ($route != '' && isset ($routes[$route]) == FALSE){
            $route = '';
        }
        
        $url = Config::get('base_uri');
        
        if($lang != '' && $lang != Config::get('default_language')) {
            $url .= "$lang/";
        }
        
        if($route != '' && $route != Config::get('default_route')) {
            $url .= "$route/";
        }
        
        if($module != '') {
            $url .= "$module/";
            
            if($action != '') {
                $url .= "$action/";
                
                foreach ($params as $paramName => $paramValue) {
                    $url .= "{$paramValue}/";
                }
            }
        }
       
        return $url;
    }
    
     public function getResourceUrl($resource) {
        return Config::get('base_uri') . $resource;
    }

}
