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

    //link do arquivo xml
	$link 		= "http://servicos.cptec.inpe.br/XML/estacao/SBPA/condicoesAtuais.xml"; 
    //carrega o arquivo XML e retornando um Array
    $CPTEC 		= simplexml_load_file($link); 
    //carrega o valor das tags do xml em $weather
	//utilizamos a função "utf8_decode" para exibir os caracteres corretamente
	$weather	= "<strong>atualizacao:</strong> "			.utf8_decode($CPTEC->atualizacao )."<br />";
	$weather	= $weather."<strong>Pressao:</strong> "		.utf8_decode($CPTEC->pressao)." hPa<br />";
	$weather	= $weather."<strong>Temperatura:</strong> "	.utf8_decode($CPTEC->temperatura)."ºC<br />";
	$weather	= $weather."<strong>Tempo:</strong> "		.utf8_decode($CPTEC->tempo_desc)."<br />";
	$weather	= $weather."<strong>Umidade:</strong> "		.utf8_decode($CPTEC->umidade)."%<br />";
	$weather	= $weather."<br />";

	echo $weather;
?>

<!--	http://servicos.cptec.inpe.br/XML/estacao/SBPA/condicoesAtuais.xml
	<metar>
		<codigo>SBPA</codigo>
		<atualizacao>09/07/2019 09:00:00</atualizacao>
		<pressao>1025</pressao>
		<temperatura>7</temperatura>
		<tempo>n</tempo>
		<tempo_desc>Nublado</tempo_desc>
		<umidade>100</umidade>
		<vento_dir>9999</vento_dir>
		<vento_int>0</vento_int>
		<visibilidade>800</visibilidade>
	</metar> -->