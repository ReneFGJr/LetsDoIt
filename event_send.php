<?php
require("cab.php");
require($include."sisdoc_data.php");

require("_class/_class_event.php");
$clx = new event;

global $acao,$dd,$cp,$tabela;

	$tabela = $clx->tabela;
	
	echo '<h1>'. 'Eventos' . '</h1>';
	$id = sonumero($dd[0]);
	$clx->le($id);
	
	echo '<table>';
	echo '<TR>';
	echo '<TD>';
	echo $clx->mostra();
	
	echo '<TD>';
	echo $clx->to_send($id);
	
	echo '</table>';
	
?>
