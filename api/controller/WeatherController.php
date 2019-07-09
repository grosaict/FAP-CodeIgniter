<?php
    class WeatherController{
        public function get_weather($request, $response)
        {
            //link do arquivo xml
            $CPTEC 		    = "http://servicos.cptec.inpe.br/XML/estacao/SBPA/condicoesAtuais.xml"; 
            //carrega o arquivo XML e retornando um Array
            $weatherJSON    = simplexml_load_file($CPTEC);

            $response = $response->withJson($weatherJSON);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withStatus(200);
            return $response;
        }
    }
?>