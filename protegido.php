<?php 

$token = $_COOKIE["jwt"];

echo "Token novo: ".$token."<br>";

$ref = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoicmFmYWVsIiwiZXhwaXJlcyI6MTc3MTI4NDgyOH0.M2M0NzJhNzJlNmZiM2RlZWEzZDlhMTk5OWMyYjY2MmNmY2VlOGEzYWE3NDNkOTczM2FiZjg3YzBlNDk1ODllZg";
echo "<br>";
if ($token != $ref){
    echo 'diferentes';
}else{
    echo "iguais";
}

