<?php
require("cab.php");

require($include."sisdoc_data.php");

require("_class/_class_event.php");
$p = new event;
//require($include.'sisdoc_debug.php');

require($include.'_class_form.php');
$form = new form;
require("form_css.php");
$cp = $p->cp();
$tabela = $p->tabela;

$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		redirecina("event.php");
	} else {
		echo $tela;
	}

?>
