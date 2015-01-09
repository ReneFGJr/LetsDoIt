<?php
require("cab.php");

require("_class/_class_person.php");
$p = new person;

require($include.'_class_form.php');
$form = new form;
require("form_css.php");
$cp = $p->cp();
$tabela = $p->tabela;

$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		redirecina("person.php");
	} else {
		echo $tela;
	}

?>
