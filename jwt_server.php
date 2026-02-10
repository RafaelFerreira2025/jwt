<?php 





$nome = $_POST["nome"];
$senha = $_POST["senha"];


$alg = "HS256";
$typ = "JWT";




$header = ["alg" => $alg, "JWT" => $typ];

$payload = ["nome" => $nome, "senha" => $senha];

$header = json_encode($header);

$payload = json_encode($payload);

$header_encoded = base64_encode($header);

$payload_encoded = base64_encode($payload);

$segredo="chave";

$texto = $header_encoded.$payload_encoded;

$signature = hash_hmac('sha256', $texto, $segredo, false);

echo $signature;



class ServidorAut{

    public $payload = [];
    public $header; 
    public $segredo = "chave";

    private $token;

    public function __construct($payload, $segredo="segredo", $header = ["alg" => "HS256", "typ" => "JWT"]){
        
        $this->header = $header;
        $this->payload = $payload;
        $this->segredo = $segredo;


    }

    public function geraToken(){

        $header_encoded = json_encode($this->header);
        $payload_encoded = json_encode($this->payload);
        
        $header_encoded = base64_encode($header_encoded);
        $payload_encoded = base64_encode($payload_encoded);
        
        $texto = $header_encoded.$payload_encoded;

        $signature = hash_hmac('sha256', $texto, $segredo, false);

        $signature = base64_encode($signature);

        $token = $texto.$signature;

        $this->token = $token;

    }

    public function getToken(){

        $token = $this->token;

        return $token;

    }

}




