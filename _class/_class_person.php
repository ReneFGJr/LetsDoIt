<?php
class person {
	var $tabela = 'person';
	
	function row() {
		global $cdf, $cdm, $masc;
		$cdf = array('id_p', 'p_name', 'p_nick','p_email_1','p_email_2');
		$cdm = array('cod', 'Nome', 'Apelido','e-mail','e-mail');
		$masc = array('', '', '');
		return (1);
	}

	function cp() {
		$cp = array();
		array_push($cp, array('$H8', 'id_p', '', False, False));
		
		array_push($cp, array('${', '', 'Nome', '', True, False));
		array_push($cp, array('$S80', 'p_name', 'Nome completo', True, True));
		array_push($cp, array('$S20', 'p_nick', 'Apelido ou primeiro nome', True, True));
		array_push($cp, array('$S80', 'p_email_1', 'e-mail', '', True, False));
		array_push($cp, array('$S80', 'p_email_2', 'e-mail (alternativo)', '', True, False));
		array_push($cp, array('$H8', 'p_codigo', '', '', True, False));
		array_push($cp, array('$H8', '', '', '', True, False));
		array_push($cp, array('$}', '', 'Nome', '', True, False));
		
		$qo = 'cy_name:cy_codigo:select * from city order by cy_ordem';
		array_push($cp, array('${', '', 'Endereço', '', True, False));
		array_push($cp, array('$Q ' . $qo, 'p_cidade', 'Cidade', '', True, True));
		array_push($cp, array('$S10', 'p_cep', 'CEP', '', True, True));
		array_push($cp, array('$S80', 'p_endereco', 'Endereço', '', True, True));
		array_push($cp, array('$S10', 'p_numero', 'Número', '', True, True));
		array_push($cp, array('$S20', 'p_complement', 'Complemento', '', True, True));
		array_push($cp, array('$S20', 'p_block', 'Bairro', '', True, True));
		array_push($cp, array('$}', '', 'Endereço', '', True, False));
		
		
		array_push($cp, array('${', '', 'Data nascimento', '', True, True));
		array_push($cp, array('$[0-31]', 'p_birthday_day', 'Dia', '', True, True));
		array_push($cp, array('$[0-12]', 'p_birthday_month', 'Mês', '', True, True));
		array_push($cp, array('$[1940-' . date("Y") . ']D', 'p_birthday_year', 'Ano', '', True, True));
		array_push($cp, array('$}', '', 'Endereço', '', True, True));

		array_push($cp, array('${', '', 'Telefone', '', True, True));
		array_push($cp, array('$S3', 'p_fone_dd', 'DDD', '', True, True));
		array_push($cp, array('$S10', 'p_phone_1', 'Telefone 1', '', True, True));
		array_push($cp, array('$S10', 'p_phone_2', 'Telefone 2', '', True, True));
		array_push($cp, array('$S10', 'p_phone_3', 'Telefone 3', '', True, True));
		array_push($cp, array('$}', '', 'Telefone', '', True, True));
		
		array_push($cp, array('$O 1:SIM&0:NÃO', 'p_active', 'Ativo', '', True, True));
		return ($cp);

	}

}
?>