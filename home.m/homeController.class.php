<?php
// Copyright 2017, Jean M. A. Miranda, All Right Reserved.
class homeController extends Controller{
	private $model;
	private $view;
	public function __construct(){
		//$this->Bloqueiar("padrao");
		$this->model=new homeModel();
		$this->view=new homeView();	
     	}
	public function index($arg){
	if($arg==""){
		$this->model->tabela="empresas";
		$this->model->Buscar();
		$this->view->mostrarIndex($this->model->header, $this->model->tbody);
	}else{
		$keys = array_keys($_POST);
		$this->model->tabela="empresas";
		$res = $this->model->Get("cnpj", "cnpj", $_POST["cnpj"]);
		if($arg=="reg"){
			if(!isset($res)){
				$this->model->Inserir($keys,$_POST);
				$this->view->Redirecionar("/home/index");
			}else
				echo "
				Já existe um cadastro com o mesmo CNPJ
				<button onclick=\"window.location = '/home/index'\">Voltar</button>";
		}else{
			if($arg=="upd"){
				$this->model->Atualizar($keys, $_POST, "id", $_POST["id"]);
				$this->view->Redirecionar("/home/index");
			}else{
				echo "
				Deseja excluir esse registro: ".$_POST["id"]."? <button onclick=\"deletar(".$_POST["id"].")\" id=yes>SIM</button>
				<button onclick=\"window.location = '/home/index'\" id=no>NÃO</button>";
			}
		}
	}
	}
	public function deletar($arg){
	$this->model->tabela="empresas";
	if($arg=="yes"){
		$this->model->Deletar("id", $_POST["id"]);
		$this->view->Redirecionar("/home/index");
	}
	}
}
