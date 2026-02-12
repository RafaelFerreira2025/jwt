<?php 

$token = $_COOKIE["jwt"];

echo "Token novo: ".$token."<br>";

$ref = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoicmFmYWVsIiwiZXhwaXJlcyI6MTc3MDkyMDQ5NH0=.NDA1NDU5YjA0NTgzYjExM2JlZWU0ZDJlMWQ3OTcxMWFjM2ZkN2Q4YmM2NTM2NzIxY2ZhMzM2ZGJmNGE0NmM2OA==";

echo "<br>";
if ($token != $ref){
    echo 'diferentes';
}else{
    echo "iguais";
}

