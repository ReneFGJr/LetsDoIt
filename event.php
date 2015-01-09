<?php
require("cab.php");
require($include."sisdoc_data.php");

require("_class/_class_event.php");
$clx = new event;

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');

	$tabela = $clx->tabela;
	
	echo '<h1>'. 'Eventos' . '</h1>';
	$http_edit = 'event_ed.php';
	
	$http_ver = 'event_dt.php';  
	
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
