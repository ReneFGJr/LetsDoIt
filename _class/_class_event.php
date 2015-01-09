<?php
class event {
	var $tabela = 'event';
	var $tabela_send = "to_send";
	var $line;
	
	function insert_to_send($person,$event)
		{
			$sql = "insert into ".$this->tabela_send." 
						(st_person, st_event, st_status)
						value
						('$person','$event','@')			
			";
			$xrlt = db_query($sql);			
		}
		
	function to_send($event)
		{
			$sql = "select * from person 
						where p_active = 1
			";
			$qrlt = db_query($sql);
			while ($line = db_read($qrlt))
				{
					$person = $line['p_codigo'];
					$this->insert_to_send($person, $event);
					echo '<BR>'.$line['p_name'];
					echo '&nbsp;';
					echo '&lt;'.$line['p_email_1'].'&gt;';
				}
		}
	
	function le($id)
		{
			$sql = "select * from ".$this->tabela."
					left join person on e_sponsor = p_codigo 
					where id_e = ".$id;
					
			$rlt = db_query($sql);
			
			if ($line = db_read($rlt))
				{
					$this->line = $line;
					return(1);
				}
			return(0);
		}
	function mostra_imagem($cod)
		{
			global $http;
			$sx = '<img src="'.$http.'events/'.strzero($cod,7).'.jpg" width="640">';
			return($sx);
		}
	function mostra()
		{
			$line = $this->line;
			
			$sx = '<table width="640" align="center">';
			$sx .= '<TR><TD>';
			$sx .= '<h2>'.trim($line['e_name']).'</h2>';
			
			/* Data e local */
			$sx .= '<TR><TD>';
			$sx .= '<h3>'.stodbr($line['e_date']).' '.$line['e_time'];
			$sx .= '<BR>'.trim($line['p_name']);
			$sx .= '</h3>';
			
			/* Imagems */
			$sx .= '<TR valign="top">';
			$sx .= '<td>';
			$sx .= $this->mostra_imagem($line['id_e']);
			$sx .= '</td>';

			$sx .= '<TR valign="top">';
			$sx .= '<td>';
			$sx .= mst(trim($line['e_text']));
			$sx .= '</td>';

			$sx .= '</table>';
			return($sx);
		}
	function row() {
		global $cdf, $cdm, $masc;
		$cdf = array('id_e', 'e_name', 'e_date', 'e_time', 'e_sent');
		$cdm = array('cod', 'Evento', 'Data', 'Hora', 'convites');
		$masc = array('', '', 'D', '', '');
		return (1);
	}

	function cp() {
		$cp = array();
		array_push($cp, array('$H8', 'id_e', '', False, False));

		array_push($cp, array('${', '', 'Evento', '', True, False));
		array_push($cp, array('$S80', 'e_name', 'Nome do evento', True, True));
		array_push($cp, array('$T40:8', 'e_text', 'Sobre o evento', False, True));
		array_push($cp, array('$D8', 'e_date', 'Data', True, True));
		array_push($cp, array('$S5', 'e_time', 'Hora', True, True));

		$op = "p_name:p_codigo:select * from person order by p_name";
		array_push($cp, array('$Q ' . $op, 'e_sponsor', 'Divugador', False, True));
		return ($cp);
	}

}
?>
