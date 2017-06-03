<?php
// Copyright 2011, 2017, Jean M. A. Miranda, All Right Reserved.
class Controller{
	public function setHeader(){
		header('Content-type: text/html; charset=ISO-8859-1'); 
	}
	public function Execucao(){
    $sec = explode(" ",microtime());
    $tempo = $sec[1] + $sec[0];
    return $tempo;
	}
	public function Bloqueiar($moduloAtual){
	  if (!isset($_SESSION['login']) || !isset($_SESSION['senha'])){
    echo "<script type='text/javascript'>
    document.location.href='/login';
    </script>";
    exit();
    }  	 
	
	$modulos=explode(";",$_SESSION['modulos']);
	for($i=0;$i<count($modulos);$i++){
	if($modulos[$i]!=$moduloAtual) $warn="Voce nao tem permissao para acessar $moduloAtual.";
	else{
		$warn="";
		break;
	}
	}
	return $warn;
  }
}
