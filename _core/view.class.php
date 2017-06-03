<?php
// Copyright 2011, 2017, Jean M. A. Miranda, All Right Reserved.
class View
{
  var $content;
  var $content2;
  var $script;
  var $storeAqui;
  function __construct(){
  }
  function SetAttribute($id,$attName,$valor){
	 $this->script.="document.getElementById('$id').setAttribute('$attName','$valor');";  
  }
  function InnerHTML($id,$html){
	 $this->script.="document.getElementById('$id').innerHTML+='$html';"; 
  }
  function AddValue($element_id,$value){
	  $this->script.="document.getElementById('$element_id').setAttribute('value','$value');";
  }
  function BeginForm(array $values){
	  $this->content.='<form action="'.$values["action"].'" method="'.$values["method"].'" name="'.$values["name"].'" style="'.$values["style"].'">';
  }
  function EndForm(){
	  $this->content.='</form>';
  }
  function BeginTable(){
	  $this->content.='<table>';
  }
  function EndTable(){
	  $this->content.='</table>';
  }
  function CreateInput(array $values, array $types){
	  $max=30;
	  for($i=0;$i<count($types[0]);$i++){
		  //if($types[0][$i]=="id"){ $readonly="readonly=readonly"; $type="number";}
		 $tok=strtok($types[1][$i],"()");
		 if($tok=="varchar"){ $readonly=""; $type="text";}
		 if($tok=="int"){ $readonly="readonly=readonly"; $type="number";}
		 if($tok=="enum"){ $readonly=""; $type="text";}
		 if($tok=="float"){ $readonly=""; $type="number step=0.01";}
		$tok=strtok("()");
		$max=$tok; $size=$tok;
		
	  $this->content.='
	  <tr>
	  <td>'.$types[0][$i].'</td>
	  <td><input '.$readonly.' type="'.$type.'" size="'.$size.'" maxlength="'.$max.'" id="'.$types[0][$i].'" name='.$types[0][$i].'" value="'.$values[$i].'" /></td>
	  </tr>
	  ';
	  }
	  $this->content.='<tr><td></td><td><input type="submit" value="Enviar" /></td><td></td><td></td></tr>';
  }
  function Display($url){
	  include($url);
  }
  function Redirecionar($url){
	  echo "<script type='text/javascript'>
    document.location.href='$url';
    </script>";
  }
  function sessionStorage($nome,$valor){
	  $this->script.="sessionStorage[\"".$nome."\"]='".$valor."';";
  }
  function DesenhaTabela($header,$tbody,$id){ 
      $content="<div id=$id>";
	  $cols=count($header);
	  $content.="<table id=box-table-a><thead><tr>";
      for($i=0;$i<$cols;$i++){
      $content.="<th>".$header[$i]."</th>";
	  }
      $content.="</tr></thead><tbody>";
	  $i=$l=0;

     for($i=0;$i<count($tbody)/$cols;$i++){
		$content.="<tr id=\"".$tbody[$l]."\" onclick=\"openLink(this)\">";
	  for($j=0;$j<$cols;$j++){	
      $content.="<td>".$tbody[$l]."</td>";
	  $l++;
      }
	   $content.="</tr>";
	  }
      $content.="</tbody></table>";
	  $content.="</div>";
	  return $content;
  }
}
