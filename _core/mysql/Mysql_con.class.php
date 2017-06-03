<?php
// Copyright 2011, 2017, Jean M. A. Miranda, All Right Reserved.
class Mysql_con
{
	protected $host = "localhost";
	protected $user = "root";
	protected $senha = "insira_senha";
	protected $database;
	protected $link;
	public function __construct($h=null,$user=null,$pass=null){
		
	}
	public function conectar($database=null)
    	{
        // Create connection
	$this->link = mysqli_connect($this->host, $this->user, $this->senha, $database);
	// Check connection
	if (!$this->link) {
	    die("Connection failed: " . mysqli_connect_error());
	}
    	}  
	public function setDatabase($db){
	$this->database=$db;	
	$this->selectDatabase();
	}
	public function getDatabase(){
		return $this->database;
    	}
	public function getLink(){
		return $this->link;
	}
	public function selectDatabase($database=null){
		if($database==null)
		mysqli_select_db($con,$this->database);
		else
		mysqli_select_db($con,$database);
	} 
	public function desconectar(){
	$this->link->close();
	}
	public function reconectar(){

	}
}
