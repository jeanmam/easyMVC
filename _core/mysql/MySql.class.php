<?php
// Copyright 2011, 2017, Jean M. A. Miranda, All Right Reserved.
class MySql extends Mysql_con
{
	var $cols=array();
	var $values=array();
	var $tabela;
	var $busca_dados;
	var $coluna;
	var $busca;
	var $num_busca;
	var $RetornarNum=TRUE;
	var $header=array();
	var $tbody=array();
	var $query = NULL;
	function __construct(){
		
	}
	function AntiSqlInjection($var){
    	//
    	return $var;
    	}
	function setTabela($table){
	$this->tabela=$table;	
	}
	function getTabela(){
	return $this->tabela;	
	}
	function ExecutarMultQuery($sql){
	mysqli_multi_query($this->link, $sql);	
	}
	function ExecutarQuery($query=NULL){
	if($query!=NULL){
		$result=$this->link->query($query) or die($this->link->connect_error);	
		return $result; 	
	}
	else if(isset($this->query)){
		$result=$this->link->query($this->query) or die($this->link->connect_error);	 	
		unset($this->query);
		return $result;
	}
	return NULL;
	}
	function Buscar(){
		unset($this->header,$this->tbody);
		//Faz busca no sql
		$this->tabela=$this->AntiSqlInjection($this->tabela);
		if(!isset($this->busca_dados) && !isset($this->query)){
		$this->busca=$this->link->query("SELECT * FROM ".$this->tabela) or die ($this->link->connect_error);	
		}else if(isset($this->busca_dados)){
		//faz busca especifica no sql
		$this->busca=$this->link->query("SELECT * FROM $this->tabela WHERE $this->coluna ='$this->busca_dados'") or die ($this->query->connect_error);
		unset($this->busca_dados);
		}else if(isset($this->query)){
		//faz busca qualquer de acordo com a query
		$this->busca=$this->link->query($this->query); // or die ($this->link->connect_error);
		unset($this->query);
		}
		if ($this->busca->num_rows > 0) {
			//Pega quantidade de registros
			if($this->RetornarNum)
				$this->num_busca = $this->busca->num_rows;

			//Contador de campos
			$count=mysqli_num_fields($this->busca);

			//Pega nome de cada Campo
			for($i=0;$i<$count;$i++){
				$name  = mysqli_fetch_field_direct($this->busca, $i)->name;
				$this->header[$i]=$name;
			}
			//Armazena os dados em um Array
			while ($reg=mysqli_fetch_array($this->busca))
			{
				for($i=0;$i<$count;$i++)
				$this->tbody[]=$reg[$i];
			}
		}	
	}
	
	function Inserir($cols,$values)
	{
		$colunas="";
		$dados="";
		$count=count($cols);
		for($i=0;$i<$count;$i++){
		$index=$cols[$i];
		$colunas.="$cols[$i] ,";
		$dados  .="'$values[$index]',";
		}
		$colunas=substr_replace($colunas, '', -1);
		$dados=substr_replace($dados, '', -1);
		if(isset($cols,$values)){
		$this->link->query("INSERT INTO $this->tabela ($colunas) VALUES ($dados)") or die($this->link->connect_error);
	    }
	}
	
	function Deletar($col,$value)
	{
	if(isset($col,$value))	
    $this->link->query("DELETE FROM $this->tabela WHERE $col = $value") or die($this->link->connect_error);
	}
	
	function Atualizar(array $cols,array $dados,$coluna,$where)
	{
		$update="";
		$count=count($cols);
		for($i=0;$i<$count;$i++){
			$name=$cols[$i];
		$update.="$name = '$dados[$name]',";
		}
		$update=substr_replace($update, '', -1);
		$this->link->query("UPDATE $this->tabela SET $update WHERE $coluna='$where' ") or die($this->link->connect_error);
	}
	
	function GetTypes(){
	$result=$this->ExecutarQuery("SHOW FIELDS FROM $this->tabela");
	$results=array(array(),array());
	 while ($reg=mysqli_fetch_array($result))
        {
		$results[0][]=$reg[Field];
		$results[1][]=$reg[Type];
		}
		return $results;
	}
	
}
