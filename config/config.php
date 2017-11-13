<?php

use Lib\Config;

Config::set('site_name','Mercado Info');
Config::set('base_uri', '/mercado/');

Config::set('languages', ['pt_br','en']);

Config::set('routes',[
    'default' => '',
    'admin' =>'admin_' 
]);

config::set('default_route','default');
config::set('default_languages','pt_br');
config::set('default_controller','produto');
config::set('default_action','index');

//definições de banco de dados

Config::set('db.host','localhost');
Config::set('db.user','root');
Config::set('db.password','vertrigo');
Config::set('db.name','mydb');