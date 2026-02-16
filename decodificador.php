<?php
require_once('lib.php');

$token = $_COOKIE["jwt"];

$token = Url::urlDecode($token);

echo "<br>".$token;