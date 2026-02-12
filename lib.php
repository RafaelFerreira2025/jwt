<?php 

class Url{

    public $data;


    public static function base64url_encode($data){
        return rtrim(strtr(base64_encode($data),'+/','-_'),"=");
    }
    public static function base64url_decode($data){
        return base64_decode(str_pad(strtr($data,"-_","+/")));
    }

}

class JWT{

    
    public $payload = [];
    public $header; 
    public $segredo = "chave";

    private $db = null;
    private $token;

    public function __construct($payload = ["user_id"=>'',"expires"=>0], $segredo = "segredo", $header = ["alg" => "HS256", "typ" => "JWT"]){
        
        $this->header = $header;
        $this->payload = $payload;
        $this->segredo = $segredo;
         

    }

    public function geraToken(){

        $header_encoded = json_encode($this->header);
        $payload_encoded = json_encode($this->payload);
        
        $header_encoded = base64_encode($header_encoded);
        $payload_encoded = base64_encode($payload_encoded);
        
        $texto = $header_encoded.".".$payload_encoded;

        #$signature = hash_hmac('sha256', $texto, $segredo, false);

        $signature = hash_hmac("sha256",$header_encoded.".".$payload_encoded, $segredo, False);

        $signature = base64_encode($signature);

        $token = $texto.".".$signature;

        $this->token = $token;

    }

    public function getToken(){

        $token = $this->token;

        return $token;

    }

    public function parseToken($token){
        /*Retorna array com dados no formato JSON_ENCODED dos campos do JWT*/ 
        $token = explode(".",$token);
        
        $header = base64_decode($token[0]);
        $payload = base64_decode($token[1]);
        $signature = base64_decode($token[2]);

        $token[0] = $header;
        $token[1] = $payload;
        $token[2] = $signature;

        return $token;

    }

    public function validateTTL($token){

        #verifica se o prazo do token é valido


        $token = $this->parseToken($token);

        $header = json_decode($token[0]);
        $payload = json_decode($token[1]);
        $signature = $token[2];


        $deadline = $payload["deadline"];
        $atual = time();
        
        if ($atual >= $deadline){
            return False;
        }

        return True;
    }

    public function validateSignature($token){


        $token = $this->parseToken($token);

        $unverified_header = $token[0];
        $unverified_payload = $token[1];
        $unverified_signature = $token[2];

        $control_token = $this->geraToken();
        $control_token = $this->parseToken($control_token);
        $control_signature = $control_token[2];

        if ($unverified_signature != $control_signature){
            return False;
        }else{
            return True;
        }

    }

}

class TokenFactory{

    public $user_id;
    public $ttl;
    public $alg;
    public $typ;
    private $segredo;

    public function __construct($segredo, $ttl=300, $alg='HS256', $typ='JWT'){
        $this->segredo = $segredo;
        $this->ttl = $ttl;
        $this->alg = $alg;
        $this->typ = $typ;

    }

    public function criaToken($user_id){
        
        $header = ["alg"=>$this->alg, "typ"=> $this->typ];
        $expires = time()+$this->ttl;
        $payload = ["user_id"=>$user_id, "expires"=>$expires];

        $token_object = new JWT($payload, $segredo, $header);
        $token_object->geraToken();
        $token = $token_object->getToken();
        
        return $token; 
    }

    public function validaToken($token){
        
        
        $token_object = new JWT();
        $ttl = $token_object->validateTTL($token);
        $signature = $token_object->validateSignature($signature);

        if ($ttl === False){
            exit('Expired token');
        }

        if($signature === False){
            exit("Invalid signature");
        }

        echo ("Valid Token!!!!! <br>");

    }

    public function payloadDecode($token_encoded){
        
        /*Retorna uma string com dados no formato JSON_ENCODED dos campos do payload do JWT*/ 
        // a variavel token é um array com 3 strings no formato json-encoded retornados por parseToken
        $token_object = new JWT();
        $token = $token_object->parseToken($token_encoded);

        $payload = $token[1];

        return $payload;
    }

    public function getSignature($token){
        $token_object = new JWT();
        $signature = $token_object->parseToken($token);
        $signature = $signature[2];
        return $signature;
    }

}


