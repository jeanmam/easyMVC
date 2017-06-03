<?php
// Copyright 2017, Jean M. A. Miranda, All Right Reserved.
class homeView extends View
{
    public function mostrarIndex($header, $tbody){
	$arg["action"]="#";
	$arg["method"]="POST";
	$arg["name"]="registro";
	$arg["style"]="position:relative;float:left;width:40%";
	$this->BeginForm($arg);
	$this->BeginTable();
	$this->content.='
		<input type="hidden" name="id" id="id" value=0 />
		<tr><td><h4>Novo Cadastro</h4></td><td></td></tr>
		<tr><td>CNPJ:</td><td><input type="text" id="cnpj" name="cnpj" style="width:300px;" /></td></tr>
		<tr><td>Razão social:</td><td><input type="text" id="socialName" name="socialName" style="width:300px;" maxlength="200" /></td></tr>
		<tr><td>Nome fantasia:</td><td><input type="text" id="fancyName" name="fancyName" style="width:300px;" maxlength="200" /></td></tr>
		<tr><td>Telefone:</td><td><input type="text" id="ddd" name="ddd" style="width:40px;" />
			<input type="text" id="phoneNumber" name="phoneNumber" style="width:240px;" /></td></tr>
		<tr><td>Site: (opcional)</td><td><input type="text" id="website" name="website" style="width:300px;" maxlength="255" /></td></tr>
		<tr><td></td><td>
<button style="width:100px" id="del">Deletar</button>
<button style="width:100px" id="upd">Atualizar</button>
<button style="width:100px" id="reg">Registrar</button>
		</td></tr>';
	$this->EndTable();
	$this->EndForm();
	$this->content.='<b><p id="aviso" name="aviso" style="position:relative;color:red;float:left;width:40%"></p></b>';
	$this->rodape = "Copyright (c) Jean Miranda, 2017";

	$this->script='
	$("#cnpj").mask("99.999.999/9999-99");
	$("#ddd").mask("99");
	$("#phoneNumber").mask("9999-9999");

	$("button").click(function(e){
		e.preventDefault();
		if($("#socialName").val()=="" || $("#fancyName").val()=="" || $("#ddd").val()=="" || $("#phoneNumber").val()==""){
			$("#aviso").html("Preencha todos os campos obrigatórios");
			window.location = "#aviso";
			return;
		}
		var cnpj = $("#cnpj").val();
		if(!validarCNPJ(cnpj)){
			$("#aviso").html("Insira um cnpj válido");
			window.location = "#aviso";
			return;
		}
		if($("#ddd").val().length!=2){
			$("#aviso").html("ddd inválido, exemplo correto: 47");
			window.location = "#aviso";
			return;
		}
		if($("#phoneNumber").val().length!=9){
			$("#aviso").html("telefone inválido, exemplo correto: 3355-1001");
			window.location = "#aviso";
			return;
		}
		$.post("/home/index/"+this.id,
		{
			id: $("#id").val(),
			cnpj: $("#cnpj").val(),
			socialName: $("#socialName").val(),
			fancyName: $("#fancyName").val(),
			ddd: $("#ddd").val(),
			phoneNumber: $("#phoneNumber").val(),
			website: $("#website").val()
		},
	function(result){
		$("#post1").html(result);
		});
	});';
	$header[0] = "ID";
	$header[1] = "CNPJ";
	$header[2] = "Razão social";
	$header[3] = "Nome fantasia";
	$header[4] = "DDD";
	$header[5] = "Telefone";
	$header[6] = "Site";
	if(isset($tbody))
		$this->content2=$this->DesenhaTabela($header, $tbody, "registros");
	else
		$this->content2="<p>Sem registros no banco de dados.<br>Comece cadastrando um novo registro no formulario acima.</p>";
	$this->Display("./home.m/template/index.tpl");
  }
}

