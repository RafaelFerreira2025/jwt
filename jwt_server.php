<?php 
#NAO ESQUECER DE REDEFINIR O LUGAR DE ONDE VEM O SEGREDO QUE ESTA NA FUNCAO validateSignature() da classe JWT.
require_once('lib.php');

$nome = $_POST["nome"];
echo $nome."<br>";

$fabrica = new TokenFactory(segredo: "chave secreta");

$token = $fabrica->criaToken($nome);

$payload = $fabrica->payloadDecode($token);

print_r($payload);