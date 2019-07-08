<?php
	echo date("r")."</br>";
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');
	//AAAA-MM-DD HH:MM:SS
	echo date("Y-m-d H:i:s")."</br>";
	$x = strftime('%Y-%m-%d %H:%M:%S')."</br>";
	echo $x;
	$y = strtotime($x);
	echo $y;
?>