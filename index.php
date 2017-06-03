<?php
// Copyright 2017, Jean M. A. Miranda, All Right Reserved.
// Report all PHP errors
error_reporting(E_ERROR | E_WARNING | E_PARSE); // E_ALL
//header('Content-type: text/html; charset=ISO-8859-1');  
  
session_start();

date_default_timezone_set('America/Sao_Paulo');


$key = (isset($_GET['key']) ? $_GET['key'] : 'home/');
$splitKey=explode("/",$key);
$modulo=$splitKey[0];
//if(count($splitKey)>1)
//$action = $splitKey[1];
//else
//$action = 'index';
$action    =($splitKey[1]==NULL ? 'index' : $splitKey[1]);
if(count($splitKey)>2)
$arg=$splitKey[2];
else
$arg = '';


require_once(__DIR__.'/_core/mysql/Mysql_con.class.php');
require_once(__DIR__.'/_core/mysql/MySql.class.php');
require_once(__DIR__.'/_core/controller.class.php');
require_once(__DIR__.'/_core/view.class.php');
require_once(__DIR__.'/_core/model.class.php');

require_once("./".$modulo.".m/".$modulo.'Controller.class.php');
require_once("./".$modulo.".m/".$modulo.'View.class.php');
require_once("./".$modulo.".m/".$modulo.'Model.class.php');

$modulo2=$modulo."Controller";
$app=new $modulo2();
$app->$action($arg);

//phpinfo();
