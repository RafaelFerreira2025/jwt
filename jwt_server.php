<?php 
#NAO ESQUECER DE REDEFINIR O LUGAR DE ONDE VEM O SEGREDO QUE ESTA NA FUNCAO validateSignature() da classe JWT.
require_once('lib.php');

$nome = $_POST["nome"];
// echo $nome."<br>";

$fabrica = new TokenFactory(segredo: "chave secreta");

$token = $fabrica->criaToken($nome);

$payload = json_decode($fabrica->payloadDecode($token), True);

setcookie("jwt", $token, $payload["expires"],"/");
header('Location:protegido.php');

$mostrar = function (){echo "<br>Token JWT:  ".$token;echo "<br><br>";echo "Payload do JWT<br>";print_r($payload);};
// $mostrar();