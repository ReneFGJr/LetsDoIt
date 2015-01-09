<?php
 /**
  * Mensagens
  * @author Rene Faustino Gabriel Junior  (Analista-Desenvolvedor)
  * @copyright Copyright (c) 2012 - sisDOC.com.br
  * @access public
  * @version v0.12.07
  * @package Class
  * @subpackage mensagens
 */

$lg = new message;
$lg->language_set($_GET['idioma']);
$LANG = $lg->language_read();

if (strlen($LANG) == 0) {
	$idiona = $lg -> language_detect();
	$lg -> language_set($idioma);
}
//$LANG = 'en_US';
class message 
	{
	/**
	 * Classe de mensagens
	 */
	var $LANG = 'en';
	var $tabela = '_messages';
	
	/**
	 * Identifica��o de idioma
	 */
	
	function edit_mode($op)
		{
			global $edit_mode;
			$edit_mode = round($op);
			$mm = 'edmode_0';
			if ($edit_mode > 0) { $edit_mode = 1; $mm = 'edmode_2';}
			$_SESSION['editmode'] = $op;
			$sx = msg($mm);
			return($sx);
		}

	function language_detect() {
		$idioma = 'en';
		$idm = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		if (strpos($idm, ',') > 0) { $idm = substr($idm, 0, strpos($idm, ','));
		}
		if (strpos($idm, ';') > 0) { $idm = substr($idm, 0, strpos($idm, ','));
		}
		$ida = array(
		/** Ingl�s **/
			'en' => 'en_US', 'en-us' => 'en_US', 'en-GB' => 'en_US', 'us' => 'en_US', 'en-gb' => 'en_US', 'en-za' => 'en_US', 'en-ie' => 'en_US', 'en-ca' => 'en_US', 'en-au' => 'en_US',
		/** Alemao **/
			'de' => 'de', 'de-at' => 'de', 'de-lu' => 'de', 'de-ch' => 'de', 'de-li' => 'de',
		/** Espanhol e Casteliano **/
			'es' => 'es',
		/** Portugues **/
			'pt-br' => 'pt_BR', 'pt' => 'pt_BR');
		$idm = $ida[$idm];
		if (strlen($idm) > 0) { $idioma = $idm;
		}
		return ($idioma);
	}

	/**
	 * Campos de edi��o e altera��o da tabela
	 */
	function cp() {
		$cp = array();
		array_push($cp, array('$H8', 'id_msg', 'key', False, True));
		array_push($cp, array('$H8', 'msg_pag', msg('page'), False, True));
		array_push($cp, array('$O pt_BR:Portugues Brasil&en_US:English&es:Spanish', 'msg_language', msg('language'), True, False));
		array_push($cp, array('$S40', 'msg_field', msg('field'), True, False));
		array_push($cp, array('$T60:4', 'msg_content', msg('content'), True, True));
		array_push($cp, array('$O 1:YES&0:NO', 'msg_ativo', msg('active'), True, True));
		return ($cp);
	}
	
	/**
	 * Carrega todas as mensagens de uma p�gina e referencia
	 */

	function message_name_all($ref, $page) {
		$msg = array();
		$sql = "select * from " . $this->tabela;
		$sql .= " where (msg_field = '" . $ref . "') ";
		$sql .= " and (msg_ativo = 1) ";
		$sql .= " order by id_msg ";		
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			array_push($msg, array($line['id_msg'], $line['msg_language'], $line['msg_content']));
		}
		return ($msg);
	}
	/**
	 * Idiomas do sistema
	 */
	 

	function idioma() {
		$idi = array('pt_BR' => 'Portugues', 'en_US' => 'English (USA)', 'es' => 'Spanish', 'fr' => 'Frensh');
		return ($idi);
	}
	/**
	 * Formul�rio para sele��o de idioma
	 */
	function idioma_form()
		{
			global $LANG;
			$ido = $this->idioma();
			$sx = '';
			foreach ($ido as $key => $value) 
				{
					$sel = '';
					if (trim($LANG) == trim($key)) { $sel = 'selected'; }
					$sx .= ' <option value="'.$key.'" '.$sel.'>'.$value.'</option>'; 
				} 
			return($sx);

		}	

	/* Recupera linguagem */
	function language_read() {
		global $LANG;
		$LANG = 'en_US';
		$lng = $_SESSION['language'];
		if (strlen($lng) > 0) { $LANG = $lng;
		}
		return ($LANG);
	}

	/* Seleciona a Linguagem */
	function language_set($lg) {
		global $LANG;
		if (strlen($lg) > 0) 
		{
			$_SESSION['language'] = $lg;
			//redirecina(page());		
		}
		return (1);
	}

	/**
	 * Exporta��o - criar arquivo com mensagens das p�ginas
	 */
	function language_page_create() {
		$cr = chr(13).chr(10);
		$pags = array();
		$sql = "select msg_language from _messages group by msg_language";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) { array_push($pags, $line['msg_language']); }

		/* Constroi as paginas */
		for ($ro = 0; $ro < count($pags); $ro++) {
			$sql = "select * from _messages where (msg_ativo = 1) ";
			$sql .= " and (msg_language = '" . $pags[$ro] . "') ";
			$sql .= " order by msg_language, msg_field ";
			$rlt = db_query($sql);

			$sx = '';

			/* Construi arquivo */
			$sx = '<?php' . $cr;
			$sx .= '/* Arquivo de Mensagens das paginas */' . $cr;
			$sx .= '$messa = array(' . $cr;
			$idio = "xxx";
			$it = 0;
			while ($xline = db_read($rlt)) {
				$xlan = trim($xline['msg_language']);
				$xfile = trim($xline['msg_field']);
				if ($xlan != $idio) {
					if ($it > 0) { $sx .= $cr . ') ,';
					}
					$sx .= $cr;
					$sx .= '/* New Language ' . $xline['msg_language'] . ' */';
					$sx .= $cr;
					$sx .= "'" . trim($xline['msg_language']) . "'=>";
					$sx .= " array(" . $cr;
					$it = 0;
					$idio = $xlan;
				}

				if ($it > 0) { $sx .= ',' . chr(13);
				}
				$sx .= "             '" . trim($xline['msg_field']) . "'=>'" . trim($xline['msg_content']) . "' ";
				$it++;
			}
			$sx .= $cr . ')';
			$sx .= '); ';
			$sx .= $cr;

			/* Salvar arquivo */
			$arq = 'messages/msg_' . trim($pags[$ro]);
			$fld = fopen($arq.'.php', 'w+');
			fwrite($fld, $sx);
			fwrite($fld, '?>');
			fclose($fld);
		}
		$arq = page();
		
	}

	/** Gerar c�digo das mensagens */
	function updatex() 
	{
	}
	
	/* Modelagem da strutura da tabela */
	function structure() {
		$sql = "CREATE TABLE _messages (
			id_msg serial NOT NULL,
			msg_pag CHAR(50),
			msg_language CHAR(5),
			msg_field CHAR(40),
			msg_content TEXT,
			msg_ativo INT
			)";
		$rlt = db_query($sql);
		return ($sql);
	}

}
/**
 * Mostra mensagem de texto conforme o conte�do gravado
 * Caso n�o exista a mensagem, envia para fun��o de cadastrar nova
 */
function msg($s) {
	return($s);
	global $LANG,$http;
	global $messa;
	global $gerar, $edit_mode;
	$s = substr($s,0,40);
	$gerar = 0;
	if (isset($messa[$LANG][$s])) 
		{
			
			/* Campos para editar mensagens */
			$img = '<A href="javascript:newxy2(';
			$img .= "'http://www2.pucpr.br/reol/message_ed_pop.php?dd2=" . page() . "&dd1=" . $s;
			$img .= "',600,300);";
			$img .= '">';
			//$img .= '<img src=img/icone_alert.png width=10 border=0>';
			$img .= '<font color="orange">(e)</font>';
			$img .= '</A>';
			if ($edit_mode!=1) { $img = ''; }
			$link = $img;
			return ($messa[$LANG][$s] . $link);
		} else {
			$msg = new message;
			$ido = $msg->idioma();
			foreach ($ido as $key => $value) 
					{ $tela = msg_insert($s,$key); } 
			return($s);
		}
	/**
	 * Inserir nova mensagem se n�o cadastrada
	 */
}
function msg_insert($s,$idioma)
		{
			global $edit_mode;
			$s = substr($s,0,40);
			$sql = "select * from _messages 
				where msg_language='$idioma' and msg_field ='$s' ";
			
			$txt = $s;
			$rlt = db_query($sql);
			if (!($line = db_read($rlt)))
				{
					if (!($edit_mode == 1))
						{	
						$sqlx = "insert into _messages ";
						$sqlx .= "(msg_pag,msg_field,msg_language,msg_content,msg_ativo)";
						$sqlx .= "values ";
						/* pt_BR */
						$sql = $sqlx . "('','" . $s . "','".$idioma."','" . $txt . "',1);";
						$rlt = db_query($sql);
						}
				}
			return(1);		
		}
?>