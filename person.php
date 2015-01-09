<?php
require("cab.php");

require("_class/_class_person.php");
$clx = new person;

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');

	$tabela = $clx->tabela;
	
	echo '<h1>'. 'Pessoas' . '</h1>';
	$http_edit = 'person_ed.php'; 
	
 	$editar = True;
	
	$http_redirect = page();
	$editar = True;
	
	$clx->row();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	//exit;
	$tab_max = "100%";
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';

require("foot.php");
?>
