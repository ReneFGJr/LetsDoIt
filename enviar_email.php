<?php
require("cab.php");
require($include.'sisdoc_data.php');

require($include.'sisdoc_debug.php');

require("_class/_class_event.php");
$e = new event;

$sql = "select * from to_send
			inner join person on st_person = p_codigo
			inner join event on st_event = id_e 
			where st_status = '@' ";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		$hd->email_type = 'AUTH';
		$body_text = mst($line['e_text']);
		$link = trim($line['e_link']);
		$titulo = $line['e_name'];
		$nome = trim($line['p_name']);

		$title = trim($titulo);
		$title .= ' - '.stodbr($line['e_date']).' ';
		if (strlen($line['e_time']) > 0) { $title .= ' a partir das '.trim($line['e_time']); }		
		
		if (strlen($link) > 0) { $link = '<A HREF="'.$link.'" style="color: #E0E0ff;">'.$link.'</A>'; }
		
		$email_addr = trim($line['p_email_1']);
		$email_nome = trim($line['p_name']);

		$title_sample = $title.' - '.'ID:'.substr(md5($line['id_e'].date("s")),0,10);
		
			
		/* Link para o Face */	
		$face = '<HR>Link para o facebook: '.$link.'<HR>';			
			
		$body_event = '<h2>'.$title.'</h2>';
		$body_person = 	'<B>'.$nome.'</B>, pestigie!<BR><BR>';
		$body_image = $e->mostra_imagem($line['id_e']).'<BR><BR>';
		
		$body_foot = '<BR><BR><BR><HR width="300"><IMG SRC="'.$http.'/img/logo_mailer_mini.png" border=0 height="50"><BR>';
		
		echo '-->'.$email_addr;
		//enviaremail($email,'','t1',$texto);
		
		/* Marketing */
		$body = '<div style="background: black; color: white; padding: 10px;">';
		$body .= $body_person;
		$body .= $body_event;
		$body .= $face;
		$body .= '<center>';
		$body .= $body_image;
		$body .= $body_text;
		$body .= $body_foot;
		$body .= '<center>';
		$body .= '</div>';

		require("_email.php");
		echo '<BR>Enviado para '.$email;
				
	}
?>
