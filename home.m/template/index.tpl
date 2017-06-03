<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css" title="currentStyle">
            @import "/_public/css/layout.css";
.buttons {
	margin:auto 0;
        text-align: center;
}
</style>
<script src="/_public/js/jquery.js"></script>
<script src="/_public/js/jquery.maskedinput.min.js"></script>
<script src="/_public/js/validarCNPJ.js"></script>
<script>
function deletar(id){
	$.post("/home/deletar/yes",
	{
		id: id,
	},
	function(result){
		$("#post1").html(result);
	});
}
function openLink(object){
$("input:hidden").val(object.getElementsByTagName('td')[0].innerHTML);
$("#cnpj").val(object.getElementsByTagName('td')[1].innerHTML);
$("#socialName").val(object.getElementsByTagName('td')[2].innerHTML);
$("#fancyName").val(object.getElementsByTagName('td')[3].innerHTML);
$("#ddd").val(object.getElementsByTagName('td')[4].innerHTML);
$("#phoneNumber").val(object.getElementsByTagName('td')[5].innerHTML);
$("#website").val(object.getElementsByTagName('td')[6].innerHTML);
$("#reg").html("Novo");
$("#upd").show();
$("#del").show();
}
$( document ).ready(function() {
$("#upd").hide();
$("#del").hide();
<?php
echo $this->script;
?>
});
</script>
<title>CRUD empresas</title>
</head>
<body class="body">
<div id="container" class="container">
<div id="header" class="header"><h2 style="padding-left:10px; color:white;">Registro de Empresas</h2>
</div>
<div id="content" class="content">
<div id="post1" class="post1">
<?php
echo $this->content;
?>
</div>
<div id="post2" class="post2">
<?php
echo $this->content2;
?>
</div>
</div>

<div class="rodape">
<?php
echo $this->rodape;
?>
</div>
</div>
</body>
