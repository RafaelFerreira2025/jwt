<?php 
require_once('lib.php');
function compararTokens(){

$token = $_COOKIE["jwt"];

echo "Token novo: ".$token."<br>";

$ref = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoicmFmYWVsIiwiZXhwaXJlcyI6MTc3MTI4NDgyOH0.M2M0NzJhNzJlNmZiM2RlZWEzZDlhMTk5OWMyYjY2MmNmY2VlOGEzYWE3NDNkOTczM2FiZjg3YzBlNDk1ODllZg";
echo "<br>";
if ($token != $ref){
    echo 'diferentes';
}else{
    echo "iguais";
}

}

if(isset($_COOKIE["jwt"])){

    $token = $_COOKIE["jwt"]; 
    
    $hora = time();

    $fabrica = new TokenFactory();
    $payload = $fabrica->payloadDecode($token);

    $payload = json_decode($payload);

    $payload = $payload->expires;
    echo $payload;
    echo "<br>Hora atual".time();

}else{
    // $_POST['autentificado']="valido";
    header('Location:cliente.php');
}
