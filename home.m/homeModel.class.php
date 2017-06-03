<?php
// Copyright 2017, Jean M. A. Miranda, All Right Reserved.
class homeModel extends Model
{
	public $lastMsgs;
	public $sendLog = false;
    	function __construct(){
	$this->conectar("marte"); 
	}
	function __destruct(){
	$this->desconectar();	
	}
	function Get($select,$col,$key){
	$this->query="SELECT $select FROM $this->tabela WHERE $col='$key'";
	$this->Buscar();
	return $this->tbody[0];
	}
	function GetA($select,$col,$key){
	$this->query="SELECT $select FROM $this->tabela WHERE $col='$key'";
	$this->Buscar();
	return $this->tbody;
	}
}
?>
